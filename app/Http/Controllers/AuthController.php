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
            'login_as' => 'nullable|in:donatur,pengelola',
        ]);

        $loginAs = $request->input('login_as', 'donatur');

        if ($loginAs === 'pengelola') {
            return $this->loginPengelola($request);
        }

        return $this->loginDonatur($request);
    }

    // 3. Proses Logout
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // 4. Showregister dan Register

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:donatur,email',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'password' => 'required|min:6|confirmed',
            'terms' => 'accepted',
        ]);

        Donatur::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'password_hash' => Hash::make($validated['password']),
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

    private function loginDonatur(Request $request)
    {
        $donatur = Donatur::where('email', $request->email)->first();

        if (! $donatur || ! $this->passwordMatches($request->password, $donatur->password_hash, $donatur)) {
            return back()->withErrors(['email' => 'Email atau password salah!']);
        }

        $donatur->save();
        $request->session()->regenerate();

        session([
            'auth_type' => 'donatur',
            'auth_id' => $donatur->id_donatur,
            'auth_name' => $donatur->nama,
        ]);

        return redirect()->intended('/kampanye');
    }

    private function loginPengelola(Request $request)
    {
        $pengelola = Pengelola::where('email', $request->email)->first();

        if (! $pengelola || ! $this->passwordMatches($request->password, $pengelola->password_hash, $pengelola)) {
            return back()->withErrors(['email' => 'Email atau password salah!']);
        }

        if (($pengelola->status ?? 'aktif') !== 'aktif') {
            return back()->withErrors(['email' => 'Akun pengelola sedang nonaktif.']);
        }

        $pengelola->save();
        $request->session()->regenerate();

        session([
            'auth_type' => 'pengelola',
            'auth_id' => $pengelola->id_pengelola,
            'auth_name' => $pengelola->nama,
            'auth_role' => $pengelola->role,
        ]);

        return redirect()->intended('/pengelola/dashboard');
    }
}
