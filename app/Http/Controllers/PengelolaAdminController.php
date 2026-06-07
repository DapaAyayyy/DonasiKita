<?php

namespace App\Http\Controllers;

use App\Models\Pengelola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PengelolaAdminController extends Controller
{
    public function index(Request $request)
    {
        $admin = Pengelola::query()
            ->when($request->filled('q'), fn ($q) => $q->where('nama', 'like', '%' . $request->q . '%')->orWhere('email', 'like', '%' . $request->q . '%'))
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('pengelola.admin.index', compact('admin'));
    }

    public function create()
    {
        return view('pengelola.admin.create', ['admin' => null]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['password_hash'] = Hash::make($data['password']);
        unset($data['password']);
        Pengelola::create($data);

        return redirect()->route('pengelola.admin.index')->with('success', 'Akun pengelola berhasil ditambahkan.');
    }

    public function show(Pengelola $admin)
    {
        $admin->load(['kampanye', 'laporan']);
        return view('pengelola.admin.show', compact('admin'));
    }

    public function edit(Pengelola $admin)
    {
        return view('pengelola.admin.edit', compact('admin'));
    }

    public function update(Request $request, Pengelola $admin)
    {
        $data = $this->validated($request, $admin->id_pengelola);
        if (! empty($data['password'])) {
            $data['password_hash'] = Hash::make($data['password']);
        }
        unset($data['password']);
        $admin->update($data);

        if ((int) session('auth_id') === (int) $admin->id_pengelola) {
            session(['auth_name' => $admin->nama, 'auth_role' => $admin->role]);
        }

        return redirect()->route('pengelola.admin.index')->with('success', 'Akun pengelola berhasil diperbarui.');
    }

    public function destroy(Pengelola $admin)
    {
        if ((int) session('auth_id') === (int) $admin->id_pengelola) {
            return back()->withErrors(['delete' => 'Akun yang sedang login tidak bisa dihapus.']);
        }

        if ($admin->kampanye()->exists() || $admin->laporan()->exists()) {
            return back()->withErrors(['delete' => 'Akun pengelola masih terhubung dengan kampanye/laporan. Nonaktifkan akun sebagai alternatif.']);
        }

        $admin->delete();
        return redirect()->route('pengelola.admin.index')->with('success', 'Akun pengelola berhasil dihapus.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:pengelola,email,' . $ignoreId . ',id_pengelola',
            'no_hp' => 'nullable|string|max:20',
            'role' => 'required|string|max:50',
            'status' => 'required|in:aktif,nonaktif',
            'password' => ($ignoreId ? 'nullable' : 'required') . '|string|min:6',
        ]);
    }
}
