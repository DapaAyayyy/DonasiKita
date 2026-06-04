<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Donatur;
use App\Models\Pengelola;

class AuthController extends Controller
{
    // 1. Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login'); 
    }

    // 2. Proses Login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        
        // SKENARIO A: Cek Login Donatur
        
        $donatur = Donatur::where('email', $request->email)->first();
        
        // Pengecekan menggunakan Hash::check sesuai instruksi Increment 2
        if ($donatur && Hash::check($request->password, $donatur->password_hash)) {
            
            // Simpan Session Donatur
            session([
                'auth_type' => 'donatur',
                'auth_id'   => $donatur->id_donatur,
                'auth_name' => $donatur->nama
            ]);
            
            return redirect('/donatur/dashboard');
        }

        // SKENARIO B: Cek Login Pengelola

        $pengelola = Pengelola::where('email', $request->email)->first();
        
        if ($pengelola && Hash::check($request->password, $pengelola->password_hash)) {
            
            // Simpan Session Pengelola
            session([
                'auth_type' => 'pengelola',
                'auth_id'   => $pengelola->id_pengelola,
                'auth_name' => $pengelola->nama,
                'auth_role' => $pengelola->role 
            ]);

            return redirect('/pengelola/dashboard');
        }

        
        // JIKA GAGAL LOGIN
        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

    // 3. Proses Logout
    public function logout(Request $request)
    {
        // Hapus semua data session
        $request->session()->flush();
        
        return redirect('/');
    }

    // 3. Proses Logout
    public function logout(Request $request)
    {
        // Hapus semua data session
        $request->session()->flush();
        
        return redirect('/');
    }

    // --- TARUH METHOD TUGASMU DI SINI ---

    public function showRegister()
    {
        return view('auth.register'); 
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:donatur,email', 
            'password' => 'required|min:6' 
        ]);

        Donatur::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password_hash' => Hash::make($request->password), 
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}