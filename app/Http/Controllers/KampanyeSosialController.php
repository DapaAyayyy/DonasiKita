<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use App\Models\Feedback;
use App\Models\KampanyeSosial;
use Illuminate\Http\Request;

class KampanyeSosialController extends Controller
{
    // Method untuk Landing Page (Route: /)
    public function home()
    {
        $kampanyes = KampanyeSosial::with('penerima')
            ->orderBy('id_kampanye', 'desc')
            ->take(6)
            ->get();

        // 2. Ambil data statistik untuk angka di bagian atas halaman
        $totalKampanye = KampanyeSosial::count();
        $totalDana = KampanyeSosial::sum('terkumpul');
        $totalDonatur = Donatur::count(); // Pastikan Anda sudah meng-import model Donatur di atas file controller

        // 3. Lempar variabel ke view 'index'
        return view('index', compact('kampanyes', 'totalKampanye', 'totalDana', 'totalDonatur'));
    }

    // Method untuk Daftar Kampanye (Route: /kampanye)
    public function index(Request $request)
    {
        $kategori = strtolower((string) $request->query('kategori', ''));
        $search = trim((string) $request->query('q', ''));

        $query = KampanyeSosial::with('penerima');

        if ($kategori !== '') {
            $query->whereHas('penerima', function ($penerimaQuery) use ($kategori) {
                $penerimaQuery->whereRaw('LOWER(kategori_penerima) = ?', [$kategori]);
            });
        }

        if ($search !== '') {
            $query->where(function ($kampanyeQuery) use ($search) {
                $kampanyeQuery->where('judul_kampanye', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhereHas('penerima', function ($penerimaQuery) use ($search) {
                        $penerimaQuery->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        $kampanye = $query->orderBy('tanggal_dibuat', 'desc')->get();

        return view('kampanye.index', compact('kampanye', 'kategori', 'search'));
    }

    // Route: /kampanye/{id}
    public function show($id)
    {
        $kampanye = KampanyeSosial::with([
            'penerima',
            'laporan' => function ($query) {
                $query->orderByDesc('tanggal_dibuat')
                    ->orderByDesc('id_laporan');
            },
            'donasi' => function ($query) {
                $query->where('status_donasi', 'berhasil')
                    ->orderByDesc('tanggal_donasi')
                    ->orderByDesc('id_donasi')
                    ->limit(5);
            },
            'donasi.donatur',
        ])->findOrFail($id);

        $totalRiwayatDonasi = $kampanye->donasi()
            ->where('status_donasi', 'berhasil')
            ->count();

        // Tarik pesan dukungan dari feedback donasi yang sudah berhasil.
        $feedbackQuery = Feedback::with('donasi.donatur')
            ->whereHas('donasi', function ($query) use ($id) {
                $query->where('id_kampanye', $id)
                    ->where('status_donasi', 'berhasil');
            });

        $totalDukungan = (clone $feedbackQuery)->count();

        $feedbacks = $feedbackQuery
            ->orderByDesc('tanggal_feedback')
            ->orderByDesc('id_feedback')
            ->limit(5)
            ->get();

        return view('kampanye.show', compact(
            'kampanye',
            'feedbacks',
            'totalRiwayatDonasi',
            'totalDukungan'
        ));
    }
}
