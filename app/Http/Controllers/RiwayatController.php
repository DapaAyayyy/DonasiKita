<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;

class RiwayatController extends Controller
{
    public function index()
    {
        // 1. Cek apakah user yang login benar-benar seorang donatur
        if (session('auth_type') !== 'donatur') {
            return redirect('/login')->withErrors(['msg' => 'Silakan login sebagai donatur terlebih dahulu.']);
        }

        // 2. Ambil ID donatur dari session
        $id_donatur = session('auth_id');

        // 3. Tarik data donasi milik donatur tersebut, relasikan, dan urutkan
        $riwayat = Donasi::with(['kampanye', 'metodePembayaran'])
            ->where('id_donatur', $id_donatur)
            ->orderBy('tanggal_donasi', 'desc')
            ->get();

        // 4. Lempar data ke view (Frontend 1 yang akan buat file riwayat.blade.php)
        return view('riwayat', compact('riwayat'));
    }
}