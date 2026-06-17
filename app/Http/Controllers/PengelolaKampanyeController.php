<?php

namespace App\Http\Controllers;

use App\Models\KampanyeSosial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengelolaKampanyeController extends Controller
{
    private array $statuses = ['pending', 'aktif', 'selesai', 'dibatalkan'];

    public function index(Request $request)
    {
        $kampanye = KampanyeSosial::with(['penerima', 'pengelola'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('q'), fn ($q) => $q->where('judul_kampanye', 'like', '%' . $request->q . '%'))
            ->orderByDesc('id_kampanye')
            ->paginate(10)
            ->withQueryString();
        $statusOptions = $this->statuses;

        return view('pengelola.kampanye.index', compact('kampanye', 'statusOptions'));
    }

    public function create()
    {
        return view('pengelola.kampanye.create', $this->formData());
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['id_pengelola'] = session('auth_id');
        $data['terkumpul'] = 0;
        $data['foto_sampul'] = $this->storeSampul($request) ?? $data['foto_sampul'] ?? null;

        KampanyeSosial::create($data);

        return redirect()->route('pengelola.kampanye.index')->with('success', 'Kampanye berhasil ditambahkan.');
    }

    public function show(KampanyeSosial $kampanye)
    {
        $kampanye->load(['penerima', 'pengelola', 'donasi.donatur', 'laporan']);
        return view('pengelola.kampanye.show', compact('kampanye'));
    }

    public function edit(KampanyeSosial $kampanye)
    {
        return view('pengelola.kampanye.edit', $this->formData($kampanye));
    }

    public function update(Request $request, KampanyeSosial $kampanye)
    {
        $data = $this->validated($request);
        $data['foto_sampul'] = $this->storeSampul($request) ?? $data['foto_sampul'] ?? $kampanye->foto_sampul;

        $kampanye->update($data);
        $this->recalculateTerkumpul((int) $kampanye->id_kampanye);

        return redirect()->route('pengelola.kampanye.index')->with('success', 'Kampanye berhasil diperbarui.');
    }

    public function destroy(KampanyeSosial $kampanye)
    {
        if ($kampanye->donasi()->exists()) {
            return back()->withErrors(['delete' => 'Kampanye yang sudah memiliki donasi tidak bisa dihapus.']);
        }

        $kampanye->delete();
        return redirect()->route('pengelola.kampanye.index')->with('success', 'Kampanye berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'id_penerima' => 'required|exists:penerima,id_penerima',
            'judul_kampanye' => 'required|string|max:200',
            'deskripsi' => 'required|string',
            'target_donasi' => 'required|numeric|min:1',
            'foto_sampul' => 'nullable|string|max:255',
            'foto_sampul_file' => 'nullable|image|max:2048',
            'deadline' => 'required|date',
            'status' => 'required|in:' . implode(',', $this->statuses),
        ]);
    }

    private function formData(?KampanyeSosial $kampanye = null): array
    {
        return [
            'kampanye' => $kampanye,
            'penerimaOptions' => DB::table('penerima')->orderBy('nama')->get(['id_penerima', 'nama']),
            'statusOptions' => $this->statuses,
        ];
    }

    private function storeSampul(Request $request): ?string
    {
        if (! $request->hasFile('foto_sampul_file')) {
            return null;
        }

        $file = $request->file('foto_sampul_file');
        $name = 'sampul_' . uniqid('', true) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images'), $name);

        return $name;
    }

    private function recalculateTerkumpul(int $idKampanye): void
    {
        $total = DB::table('donasi')
            ->where('id_kampanye', $idKampanye)
            ->where('status_donasi', 'berhasil')
            ->sum('nominal');

        DB::table('kampanye_sosial')->where('id_kampanye', $idKampanye)->update(['terkumpul' => $total]);
    }
    public function destroyFeedback(\App\Models\Feedback $feedback)
    {
        $feedback->delete();
        return back()->with('success', 'Komentar berhasil dihapus dari peredaran.');
    }
}
