<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use App\Models\Feedback;
use App\Models\KampanyeSosial;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class KampanyeSosialController extends Controller
{
    // Method untuk Landing Page (Route: /)
    public function home()
        {
            // TAMBAHAN: Filter cuma nampilin yang 'aktif'
            $kampanyes = KampanyeSosial::with('penerima')
                ->where('status', 'aktif') 
                ->orderBy('id_kampanye', 'desc')
                ->take(6)
                ->get();
    
            $totalKampanye = KampanyeSosial::count();
            $totalDana = KampanyeSosial::sum('terkumpul');
            $totalDonatur = Donatur::count();
    
            return view('index', compact('kampanyes', 'totalKampanye', 'totalDana', 'totalDonatur'));
        }

    // Method untuk Daftar Kampanye (Route: /kampanye)
    public function index(Request $request)
        {
            $kategori = strtolower((string) $request->query('kategori', ''));
            $search = trim((string) $request->query('q', ''));
            $perPage = 25;
    
            // TAMBAHAN: Filter awal harus yang 'aktif'
            $query = KampanyeSosial::with('penerima')->where('status', 'aktif');
    
            if ($search !== '') {
                $query->where(function ($kampanyeQuery) use ($search) {
                    $kampanyeQuery->where('judul_kampanye', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%")
                        ->orWhereHas('penerima', function ($penerimaQuery) use ($search) {
                            $penerimaQuery->where('nama', 'like', "%{$search}%");
                        });
                });
            }

        if ($kategori !== '') {
            $filteredKampanye = $query->orderBy('tanggal_dibuat', 'desc')
                ->get()
                ->filter(fn ($item) => $item->kategori_virtual === $kategori)
                ->values();

            $page = LengthAwarePaginator::resolveCurrentPage();
            $kampanye = new LengthAwarePaginator(
                $filteredKampanye->forPage($page, $perPage)->values(),
                $filteredKampanye->count(),
                $perPage,
                $page,
                [
                    'path' => $request->url(),
                    'query' => $request->query(),
                ]
            );
        } else {
            $kampanye = $query->orderBy('tanggal_dibuat', 'desc')
                ->paginate($perPage)
                ->withQueryString();
        }

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
        $kataKasar = [
            // Kebun Binatang
            'anjing', 'anjeng', 'njing', 'asu', 'babi', 'monyet', 'kunyuk', 'celeng', 
            // Makian Umum & Kasar
            'bangsat', 'bajingan', 'keparat', 'kampret', 'jancuk', 'jancok', 'cok', 'taik', 'tai', 'sialan', 'brengsek',
            // Umpatan Kecerdasan
            'goblok', 'goblog', 'tolol', 'bego', 'idiot', 'dongo', 'dungu', 'pekok',
            // Kata Tidak Pantas Lainnya
            'pelacur', 'perek', 'jablay', 'lonte', 'ngentot'
        ]; 
        
        foreach ($feedbacks as $feedback) {
            // Pastikan 'pesan' ini sesuai dengan nama kolom di database lu
            $feedback->pesan = str_ireplace($kataKasar, '***', $feedback->pesan);
        }
        return view('kampanye.show', compact(
            'kampanye',
            'feedbacks',
            'totalRiwayatDonasi',
            'totalDukungan'
        ));
    }
    public function destroyFeedback(\App\Models\Feedback $feedback)
    {
        $feedback->delete();
        return back()->with('success', 'Komentar berhasil dihapus dari peredaran.');
    }
}
