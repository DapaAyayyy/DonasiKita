@extends('pengelola.layouts.app')

@section('title', 'Detail Donasi - DonasiKita')
@section('page_title', 'Detail Donasi #' . $donasi->id_donasi)

@section('content')
<div class="grid grid-cols-1 xl:grid-cols-[1fr_380px] gap-6">
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 space-y-6">
        <div class="flex items-start justify-between gap-4">
            <div>
                <p class="text-sm text-slate-500">Nominal Donasi</p>
                <p class="font-display text-4xl font-extrabold text-[#3525cd]">Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</p>
            </div>
            <x-pengelola-status :status="$donasi->status_donasi" />
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="rounded-2xl bg-slate-50 p-4"><p class="text-xs text-slate-500 mb-1">Donatur</p><p class="font-bold">{{ $donasi->donatur->nama ?? '-' }}</p><p class="text-sm text-slate-500">{{ $donasi->donatur->email ?? '' }}</p></div>
            <div class="rounded-2xl bg-slate-50 p-4"><p class="text-xs text-slate-500 mb-1">Kampanye</p><p class="font-bold">{{ $donasi->kampanye->judul_kampanye ?? '-' }}</p><p class="text-sm text-slate-500">{{ $donasi->kampanye->penerima->nama ?? '' }}</p></div>
            <div class="rounded-2xl bg-slate-50 p-4"><p class="text-xs text-slate-500 mb-1">Metode / Payment Type</p><p class="font-bold">{{ $donasi->metodePembayaran->nama_metode ?? $donasi->payment_type ?? '-' }}</p></div>
            <div class="rounded-2xl bg-slate-50 p-4"><p class="text-xs text-slate-500 mb-1">Tanggal / Paid At</p><p class="font-bold">{{ $donasi->tanggal_donasi ? \Carbon\Carbon::parse($donasi->tanggal_donasi)->format('d M Y H:i') : '-' }}</p><p class="text-sm text-slate-500">Paid: {{ $donasi->paid_at ? \Carbon\Carbon::parse($donasi->paid_at)->format('d M Y H:i') : '-' }}</p></div>
            <div class="rounded-2xl bg-slate-50 p-4"><p class="text-xs text-slate-500 mb-1">Midtrans Order ID</p><p class="font-mono text-sm break-all">{{ $donasi->midtrans_order_id ?? '-' }}</p></div>
            <div class="rounded-2xl bg-slate-50 p-4"><p class="text-xs text-slate-500 mb-1">Midtrans Transaction ID</p><p class="font-mono text-sm break-all">{{ $donasi->midtrans_transaction_id ?? '-' }}</p></div>
        </div>
        <div>
            <h2 class="font-display font-bold text-lg mb-3">Feedback / Komentar</h2>
            <div class="space-y-3">
                @forelse($donasi->feedback as $feedback)
                    <div class="rounded-2xl border border-slate-100 p-4 text-slate-700">{{ $feedback->komentar }}</div>
                @empty
                    <p class="text-slate-500">Tidak ada feedback untuk transaksi ini.</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 h-fit">
        <h2 class="font-display font-bold text-lg mb-2">Update Status Terbatas</h2>
        <p class="text-sm text-amber-700 bg-amber-50 border border-amber-100 rounded-2xl p-4 mb-5">Idealnya status donasi berasal dari callback Midtrans. Gunakan form ini untuk data lama/testing atau callback yang tidak masuk.</p>
        <form method="POST" action="{{ route('pengelola.donasi.update-status', $donasi) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <select name="status_donasi" class="w-full rounded-2xl border-slate-200">
                @foreach($statusOptions as $status)
                    <option value="{{ $status }}" @selected($donasi->status_donasi === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <button type="submit" class="w-full rounded-2xl bg-[#3525cd] text-white font-bold px-5 py-3">Simpan Status</button>
        </form>
        <a href="{{ route('pengelola.donasi.index') }}" class="block text-center mt-4 font-bold text-slate-500">Kembali ke daftar</a>
    </div>
</div>
@endsection
