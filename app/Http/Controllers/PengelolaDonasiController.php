<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengelolaDonasiController extends Controller
{
    private array $allowedStatuses = ['pending', 'berhasil', 'gagal', 'expired', 'cancelled'];

    public function index(Request $request)
    {
        $query = Donasi::with(['donatur', 'kampanye', 'metodePembayaran'])
            ->when($request->filled('status'), fn ($q) => $q->where('status_donasi', $request->status))
            ->when($request->filled('kampanye'), fn ($q) => $q->where('id_kampanye', $request->kampanye))
            ->when($request->filled('q'), function ($q) use ($request) {
                $keyword = $request->q;
                $q->where(function ($nested) use ($keyword) {
                    $nested->where('midtrans_order_id', 'like', "%{$keyword}%")
                        ->orWhere('midtrans_transaction_id', 'like', "%{$keyword}%")
                        ->orWhereHas('donatur', fn ($donatur) => $donatur->where('nama', 'like', "%{$keyword}%"))
                        ->orWhereHas('kampanye', fn ($kampanye) => $kampanye->where('judul_kampanye', 'like', "%{$keyword}%"));
                });
            })
            ->orderByDesc('tanggal_donasi')
            ->orderByDesc('id_donasi');

        $donasi = $query->paginate(10)->withQueryString();
        $kampanyeOptions = DB::table('kampanye_sosial')->orderBy('judul_kampanye')->get(['id_kampanye', 'judul_kampanye']);
        $statusOptions = $this->allowedStatuses;

        return view('pengelola.donasi.index', compact('donasi', 'kampanyeOptions', 'statusOptions'));
    }

    public function show(int $id)
    {
        $donasi = Donasi::with(['donatur', 'kampanye.penerima', 'metodePembayaran', 'feedback'])->findOrFail($id);
        $statusOptions = $this->allowedStatuses;

        return view('pengelola.donasi.show', compact('donasi', 'statusOptions'));
    }

    public function updateStatus(Request $request, int $id)
    {
        $validated = $request->validate([
            'status_donasi' => 'required|in:' . implode(',', $this->allowedStatuses),
        ]);

        DB::transaction(function () use ($id, $validated) {
            $donasi = Donasi::lockForUpdate()->findOrFail($id);
            $oldStatus = $donasi->status_donasi;
            $newStatus = $validated['status_donasi'];

            $donasi->status_donasi = $newStatus;
            if ($newStatus === 'berhasil' && empty($donasi->paid_at)) {
                $donasi->paid_at = now();
            }
            $donasi->save();

            if ($oldStatus === 'berhasil' || $newStatus === 'berhasil') {
                $this->recalculateKampanyeTerkumpul((int) $donasi->id_kampanye);
            }
        });

        return back()->with('success', 'Status donasi berhasil diperbarui dan total kampanye sudah dihitung ulang.');
    }

    private function recalculateKampanyeTerkumpul(int $idKampanye): void
    {
        $total = Donasi::where('id_kampanye', $idKampanye)
            ->where('status_donasi', 'berhasil')
            ->sum('nominal');

        DB::table('kampanye_sosial')
            ->where('id_kampanye', $idKampanye)
            ->update(['terkumpul' => $total]);
    }
}
