<?php
namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\DB;
  use Midtrans\Config;
  use Midtrans\Snap;

  class DonasiController extends Controller
  {
      public function store(Request $request, $id_kampanye)
      {
          // 1. Validasi nominal
          $request->validate([
              'nominal' => 'required|numeric|min:10000',
          ]);

          $nominal = $request->nominal;

          // Bikin Order ID unik untuk Midtrans
          $orderId = 'DONASI-' . time() . '-' . rand(100, 999);

          // 2. Konfigurasi Midtrans
          Config::$serverKey = config('midtrans.server_key');
          Config::$isProduction = config('midtrans.is_production');
          Config::$isSanitized = config('midtrans.is_sanitized');
          Config::$is3ds = config('midtrans.is_3ds');

          // 3. Siapkan data untuk Midtrans
          $params = [
              'transaction_details' => [
                  'order_id' => $orderId,
                  'gross_amount' => (int) $nominal,
              ],
              'customer_details' => [
                  'first_name' => session('auth_name') ?? 'Donatur',
              ],
          ];

          try {
              DB::beginTransaction();

              // 4. Simpan data awal ke database dengan status 'pending'
              DB::table('donasi')->insert([
                  'id_donatur' => session('auth_id'),
                  'id_kampanye' => $id_kampanye,
                  'id_metode' => 1, // Isi default dulu: Transfer BCA sesuai crowdfunding.sql
                  'nominal' => $nominal,
                  'status_donasi' => 'pending',
                  'tanggal_donasi' => now(),
                  'midtrans_order_id' => $orderId, // Kolom ini ada di crowdfunding.sql
                  // midtrans_transaction_id, payment_type, paid_at otomatis NULL
              ]);

              // 5. Generate Snap Token
              $snapToken = Snap::getSnapToken($params);

              DB::commit();

              // 6. Lempar ke halaman pembayaran
              return view('donasi.bayar', compact('snapToken', 'orderId', 'nominal'));

          } catch (\Exception $e) {
              if (DB::transactionLevel() > 0) {
                  DB::rollBack();
              }

              return back()->with('error', 'Gagal memproses ke Midtrans: ' . $e->getMessage());
          }
      }
        public function callback(Request $request)
        {
            $serverKey = config('midtrans.server_key');

            $signatureKey = hash(
                'sha512',
                $request->order_id .
                $request->status_code .
                $request->gross_amount .
                $serverKey
            );

            if ($signatureKey !== $request->signature_key) {
                return response()->json([
                    'message' => 'Invalid signature key',
                ], 403);
            }

            $orderId = $request->order_id;
            $transactionStatus = $request->transaction_status;

            if (in_array($transactionStatus, ['settlement', 'capture'])) {
                $statusDonasi = 'berhasil';
            } elseif ($transactionStatus === 'pending') {
                $statusDonasi = 'pending';
            } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                $statusDonasi = 'gagal';
            } else {
                $statusDonasi = 'pending';
            }

            DB::transaction(function () use ($request, $orderId, $statusDonasi) {
                $donasi = DB::table('donasi')
                    ->where('midtrans_order_id', $orderId)
                    ->first();

                if (!$donasi) {
                    return;
                }

                DB::table('donasi')
                    ->where('id_donasi', $donasi->id_donasi)
                    ->update([
                        'status_donasi' => $statusDonasi,
                        'midtrans_transaction_id' => $request->transaction_id,
                        'payment_type' => $request->payment_type,
                        'paid_at' => $statusDonasi === 'berhasil' ? now() : null,
                    ]);

                $totalTerkumpul = DB::table('donasi')
                    ->where('id_kampanye', $donasi->id_kampanye)
                    ->where('status_donasi', 'berhasil')
                    ->sum('nominal');

                DB::table('kampanye_sosial')
                    ->where('id_kampanye', $donasi->id_kampanye)
                    ->update([
                        'terkumpul' => $totalTerkumpul,
                    ]);
            });

            return response()->json([
                'message' => 'Callback processed successfully',
            ]);
        }
  }
