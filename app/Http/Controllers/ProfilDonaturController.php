<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donatur;
use App\Models\Donasi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfilDonaturController extends Controller
{
    // Menampilkan halaman profil
    public function show()
    {
        $idDonatur = session('auth_id');
        $donatur = Donatur::find($idDonatur);

        // Menghitung statistik (hanya donasi berhasil)
        $statistik = Donasi::where('id_donatur', $idDonatur)
            ->where('status_donasi', 'berhasil')
            ->selectRaw('COUNT(*) as total_transaksi, SUM(nominal) as total_nominal')
            ->first();

        return view('donatur.profil', compact('donatur', 'statistik'));
    }

    // Memperbarui data akun
    public function update(Request $request)
    {
        $idDonatur = session('auth_id');

        $request->validate([
            'nama'   => 'required|string|max:100',
            'email'  => 'required|email|unique:donatur,email,' . $idDonatur . ',id_donatur',
            'no_hp'  => 'nullable|string|max:20',
            'alamat' => 'nullable|string'
        ]);

        $donatur = Donatur::find($idDonatur);
        $donatur->update([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'no_hp'  => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        // Update session nama agar navbar langsung berubah
        session(['auth_name' => $donatur->nama]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // Memperbarui password
    public function updatePassword(Request $request)
    {
        $idDonatur = session('auth_id');
        
        $request->validate([
            'current_password' => 'required|string',
            'password'         => 'required|string|min:6|confirmed'
        ]);

        $donatur = Donatur::find($idDonatur);

        // Cek apakah password lama cocok
        if (!Hash::check($request->current_password, $donatur->password_hash)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah!']);
        }

        // Update password baru
        $donatur->update([
            'password_hash' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}