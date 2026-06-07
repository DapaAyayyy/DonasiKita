<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use App\Models\Donasi;
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
        return view('index', compact('kampanye', 'totalKampanye', 'totalDana', 'totalDonatur'));
    }

    // Method untuk Daftar Kampanye (Route: /kampanye)
    public function index()
    {
        $kampanye = KampanyeSosial::with('penerima')
            ->orderBy('tanggal_dibuat', 'desc')
            ->get();

        return view('kampanye.index', compact('kampanye'));
    }

    // Route: /kampanye/{id}
    public function show($id)
    {
        $kampanye = KampanyeSosial::findOrFail($id);

        // Tarik feedback dari donasi yang statusnya berhasil
        $feedbacks = Donasi::with(['donatur', 'feedback'])
            ->where('id_kampanye', $id)
            ->where('status_donasi', 'berhasil')
            ->whereHas('feedback') // Hanya ambil donasi yang punya feedback
            ->get();

        return view('kampanye.show', compact('kampanye', 'feedbacks'));
    }
}