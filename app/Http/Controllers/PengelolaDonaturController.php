<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PengelolaDonaturController extends Controller
{
    public function index(Request $request)
    {
        $donatur = Donatur::withCount('donasi')
            ->withSum(['donasi as total_donasi_berhasil' => fn ($q) => $q->where('status_donasi', 'berhasil')], 'nominal')
            ->when($request->filled('q'), fn ($q) => $q->where('nama', 'like', '%' . $request->q . '%')->orWhere('email', 'like', '%' . $request->q . '%'))
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('pengelola.donatur.index', compact('donatur'));
    }

    public function create()
    {
        return view('pengelola.donatur.create', ['donatur' => null]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['password_hash'] = Hash::make($data['password']);
        unset($data['password']);
        Donatur::create($data);

        return redirect()->route('pengelola.donatur.index')->with('success', 'Donatur berhasil ditambahkan.');
    }

    public function show(Donatur $donatur)
    {
        $donatur->load(['donasi.kampanye']);
        return view('pengelola.donatur.show', compact('donatur'));
    }

    public function edit(Donatur $donatur)
    {
        return view('pengelola.donatur.edit', compact('donatur'));
    }

    public function update(Request $request, Donatur $donatur)
    {
        $data = $this->validated($request, $donatur->id_donatur);
        if (! empty($data['password'])) {
            $data['password_hash'] = Hash::make($data['password']);
        }
        unset($data['password']);
        $donatur->update($data);

        return redirect()->route('pengelola.donatur.index')->with('success', 'Donatur berhasil diperbarui.');
    }

    public function destroy(Donatur $donatur)
    {
        if ($donatur->donasi()->exists()) {
            return back()->withErrors(['delete' => 'Donatur yang sudah memiliki transaksi tidak bisa dihapus.']);
        }

        $donatur->delete();
        return redirect()->route('pengelola.donatur.index')->with('success', 'Donatur berhasil dihapus.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:donatur,email,' . $ignoreId . ',id_donatur',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'password' => ($ignoreId ? 'nullable' : 'required') . '|string|min:6',
        ]);
    }
}
