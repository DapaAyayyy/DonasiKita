<?php

namespace App\Http\Controllers;

use App\Models\Penerima;
use Illuminate\Http\Request;

class PengelolaPenerimaController extends Controller
{
    public function index(Request $request)
    {
        $penerima = Penerima::withCount('kampanye')
            ->when($request->filled('q'), fn ($q) => $q->where('nama', 'like', '%' . $request->q . '%')->orWhere('kategori_penerima', 'like', '%' . $request->q . '%'))
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('pengelola.penerima.index', compact('penerima'));
    }

    public function create()
    {
        return view('pengelola.penerima.create', ['penerima' => null]);
    }

    public function store(Request $request)
    {
        Penerima::create($this->validated($request));
        return redirect()->route('pengelola.penerima.index')->with('success', 'Penerima manfaat berhasil ditambahkan.');
    }

    public function show(Penerima $penerima)
    {
        $penerima->load('kampanye');
        return view('pengelola.penerima.show', compact('penerima'));
    }

    public function edit(Penerima $penerima)
    {
        return view('pengelola.penerima.edit', compact('penerima'));
    }

    public function update(Request $request, Penerima $penerima)
    {
        $penerima->update($this->validated($request));
        return redirect()->route('pengelola.penerima.index')->with('success', 'Penerima manfaat berhasil diperbarui.');
    }

    public function destroy(Penerima $penerima)
    {
        if ($penerima->kampanye()->exists()) {
            return back()->withErrors(['delete' => 'Penerima masih terhubung dengan kampanye sehingga tidak bisa dihapus.']);
        }

        $penerima->delete();
        return redirect()->route('pengelola.penerima.index')->with('success', 'Penerima manfaat berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama' => 'required|string|max:100',
            'kategori_penerima' => 'nullable|string|max:50',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'deskripsi_kebutuhan' => 'nullable|string',
        ]);
    }
}
