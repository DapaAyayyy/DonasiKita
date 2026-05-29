<?php

namespace App\Http\Controllers;

use App\Models\KampanyeSosial;
use Illuminate\Http\Request;

class KampanyeSosialController extends Controller
{
    // Method untuk Landing Page (Route: /)
    public function home()
    {
        // Query kampanye terbaru dengan relasi penerima[cite: 1]
        $kampanye = KampanyeSosial::with('penerima')
            ->latest()
            ->take(3) // Mengambil 3 kampanye terbaru untuk landing page
            ->get();

        return view('home', compact('kampanye'));
    }

    // Method untuk Daftar Kampanye (Route: /kampanye)
    public function index()
    {
        // Query semua kampanye dengan relasi penerima[cite: 1]
        $kampanye = KampanyeSosial::with('penerima')
            ->latest()
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