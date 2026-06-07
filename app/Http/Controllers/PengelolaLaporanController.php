<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengelolaLaporanController extends Controller
{
    public function index(Request $request)
    {
        $laporan = Laporan::with(['kampanye', 'pengelola'])
            ->when($request->filled('q'), fn ($q) => $q->where('judul_laporan', 'like', '%' . $request->q . '%')->orWhereHas('kampanye', fn ($k) => $k->where('judul_kampanye', 'like', '%' . $request->q . '%')))
            ->orderByDesc('tanggal_dibuat')
            ->orderByDesc('id_laporan')
            ->paginate(10)
            ->withQueryString();

        return view('pengelola.laporan.index', compact('laporan'));
    }

    public function create()
    {
        return view('pengelola.laporan.create', $this->formData());
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['id_pengelola'] = session('auth_id');
        $data['file_lampiran'] = $this->storeLampiran($request) ?? $data['file_lampiran'] ?? null;
        Laporan::create($data);

        return redirect()->route('pengelola.laporan.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    public function show(Laporan $laporan)
    {
        $laporan->load(['kampanye', 'pengelola']);
        return view('pengelola.laporan.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        return view('pengelola.laporan.edit', $this->formData($laporan));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $data = $this->validated($request);
        $data['file_lampiran'] = $this->storeLampiran($request) ?? $data['file_lampiran'] ?? $laporan->file_lampiran;
        $laporan->update($data);

        return redirect()->route('pengelola.laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Laporan $laporan)
    {
        $laporan->delete();
        return redirect()->route('pengelola.laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'id_kampanye' => 'required|exists:kampanye_sosial,id_kampanye',
            'judul_laporan' => 'required|string|max:200',
            'isi_laporan' => 'nullable|string',
            'file_lampiran' => 'nullable|string|max:255',
            'file_lampiran_file' => 'nullable|file|max:4096',
        ]);
    }

    private function formData(?Laporan $laporan = null): array
    {
        return [
            'laporan' => $laporan,
            'kampanyeOptions' => DB::table('kampanye_sosial')->orderBy('judul_kampanye')->get(['id_kampanye', 'judul_kampanye']),
        ];
    }

    private function storeLampiran(Request $request): ?string
    {
        if (! $request->hasFile('file_lampiran_file')) {
            return null;
        }

        $file = $request->file('file_lampiran_file');
        $name = 'laporan_' . time() . '_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $file->getClientOriginalName());
        $file->move(public_path('assets/images'), $name);

        return $name;
    }
}
