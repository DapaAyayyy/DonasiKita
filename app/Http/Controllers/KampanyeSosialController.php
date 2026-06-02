<?php

namespace App\Http\Controllers;

use App\Models\KampanyeSosial;
use Illuminate\Http\Request;

class KampanyeSosialController extends Controller
{
    // Method untuk Landing Page (Route: /)
    public function home()
    {
        $kampanye = KampanyeSosial::with('penerima')
            ->orderBy('tanggal_dibuat', 'desc')
            ->take(3)
            ->get();

        return view('home', compact('kampanye'));
    }

    // Sesuai screenshot PM (Route: /kampanye)
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
        $kampanye = KampanyeSosial::with(['penerima', 'donasi'])->findOrFail($id);

        return view('kampanye.show', compact('kampanye'));
    }
}