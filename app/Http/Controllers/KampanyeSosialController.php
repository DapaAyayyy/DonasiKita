<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use App\Models\KampanyeSosial;
use Illuminate\Http\Request;

class KampanyeSosialController extends Controller
{
    // Method untuk Landing Page (Route: /)
// Method untuk Landing Page (Route: /)
    public function home()
    {
        // 1. Ambil 6 kampanye terbaru untuk ditampilkan di card
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
    public function index()
    {
        // Query semua kampanye dengan relasi penerima[cite: 1]
        $kampanye = KampanyeSosial::with('penerima')
            ->orderBy('tanggal_dibuat', 'desc')
            ->get();

        return view('kampanye.index', compact('kampanye'));
    }

    // Method untuk Detail Kampanye (Route: /kampanye/{id})
    public function show($id)
    {
        // Query detail kampanye dengan relasi penerima dan donasi[cite: 1]
        // Kita menggunakan find() agar jika kosong, Backend 2 bisa membuat logika penanganan errornya[cite: 1]
        $kampanye = KampanyeSosial::with(['penerima', 'donasi'])->find($id);

        return view('kampanye.show', compact('kampanye'));
    }
}