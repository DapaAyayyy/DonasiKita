<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use App\Models\Pengelola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'password' => 'required',
        ]);

        // SKENARIO A: Cek Login Donatur

        $donatur = Donatur::where('email', $request->email)->first();

        // Pengecekan menggunakan Hash::check sesuai instruksi Increment 2
          if ($donatur && $this->passwordMatches($request->password, $donatur->password_hash, $donatur)) {
            $request->session()->regenerate();

            // Simpan Session Donatur
            session([
                'auth_type' => 'donatur',
                'auth_id' => $donatur->id_donatur,
                'auth_name' => $donatur->nama,
            ]);

            return redirect()->intended('/kampanye');
        }

        // SKENARIO B: Cek Login Pengelola

        $pengelola = Pengelola::where('email', $request->email)->first();

          if ($pengelola && $this->passwordMatches($request->password, $pengelola->password_hash, $pengelola)) {
            $request->session()->regenerate();

            // Simpan Session Pengelola
            session([
                'auth_type' => 'pengelola',
                'auth_id' => $pengelola->id_pengelola,
                'auth_name' => $pengelola->nama,
                'auth_role' => $pengelola->role,
            ]);

            return redirect()->intended('/pengelola/dashboard');
        }

        // JIKA GAGAL LOGIN
        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

    // 3. Proses Logout
    public function logout(Request $request)
    {
        // Hapus semua data session dan token lama
        $request->session()->invalidate();
        $request->session()->regenerateToken();

    // 4. Showregister dan Register

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:donatur,email',
            'password' => 'required|min:6',
        ]);

        Donatur::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password_hash' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }
      private function passwordMatches(string $password, ?string $storedPassword, $user): bool
  {
      if (empty($storedPassword)) {
          return false;
      }

      $hashInfo = password_get_info($storedPassword);

      if (($hashInfo['algoName'] ?? 'unknown') === 'bcrypt') {
          return Hash::check($password, $storedPassword);
      }

      // Fallback sementara untuk data lama/manual yang password-nya belum di-hash.
      // Setelah berhasil login, password langsung di-upgrade menjadi bcrypt.
      if (hash_equals($storedPassword, $password)) {
          $user->password_hash = Hash::make($password);
          return true;
      }

      return false;
  }
}
