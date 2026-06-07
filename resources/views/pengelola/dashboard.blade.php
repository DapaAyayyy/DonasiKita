@extends('pengelola.layouts.app')

@section('title', 'Dashboard Pengelola - DonasiKita')
@section('page_title', 'Dashboard Pengelola')

@section('content')
@php
    $cards = [
        ['label' => 'Total Kampanye', 'value' => number_format($stats['total_kampanye'] ?? 0, 0, ',', '.'), 'icon' => 'campaign', 'tone' => 'bg-indigo-50 text-indigo-700'],
        ['label' => 'Kampanye Aktif', 'value' => number_format($stats['kampanye_aktif'] ?? 0, 0, ',', '.'), 'icon' => 'verified', 'tone' => 'bg-green-50 text-green-700'],
        ['label' => 'Kampanye Selesai', 'value' => number_format($stats['kampanye_selesai'] ?? 0, 0, ',', '.'), 'icon' => 'task_alt', 'tone' => 'bg-blue-50 text-blue-700'],
        ['label' => 'Dana Berhasil', 'value' => 'Rp ' . number_format($stats['total_dana'] ?? 0, 0, ',', '.'), 'icon' => 'account_balance_wallet', 'tone' => 'bg-purple-50 text-purple-700'],
        ['label' => 'Total Donatur', 'value' => number_format($stats['total_donatur'] ?? 0, 0, ',', '.'), 'icon' => 'group', 'tone' => 'bg-amber-50 text-amber-700'],
        ['label' => 'Transaksi Donasi', 'value' => number_format($stats['total_transaksi'] ?? 0, 0, ',', '.'), 'icon' => 'receipt_long', 'tone' => 'bg-slate-100 text-slate-700'],
        ['label' => 'Donasi Pending', 'value' => number_format($stats['donasi_pending'] ?? 0, 0, ',', '.'), 'icon' => 'pending_actions', 'tone' => 'bg-yellow-50 text-yellow-700'],
        ['label' => 'Donasi Berhasil', 'value' => number_format($stats['donasi_berhasil'] ?? 0, 0, ',', '.'), 'icon' => 'paid', 'tone' => 'bg-emerald-50 text-emerald-700'],
        ['label' => 'Donasi Gagal/Expired', 'value' => number_format($stats['donasi_gagal'] ?? 0, 0, ',', '.'), 'icon' => 'cancel', 'tone' => 'bg-red-50 text-red-700'],
        ['label' => 'Laporan Kampanye', 'value' => number_format($stats['total_laporan'] ?? 0, 0, ',', '.'), 'icon' => 'article', 'tone' => 'bg-cyan-50 text-cyan-700'],
    ];
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4 mb-8">
    @foreach($cards as $card)
        <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm">
            <div class="w-11 h-11 rounded-2xl {{ $card['tone'] }} flex items-center justify-center mb-4">
                <span class="material-symbols-outlined">{{ $card['icon'] }}</span>
            </div>
            <p class="text-sm text-slate-500 font-semibold">{{ $card['label'] }}</p>
            <p class="font-display text-2xl font-extrabold mt-1">{{ $card['value'] }}</p>
        </div>
    @endforeach
</div>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-display font-bold text-lg">Donasi Terbaru</h2>
            <a href="{{ route('pengelola.donasi.index') }}" class="text-sm font-bold text-[#3525cd]">Lihat semua</a>
        </div>
        <div class="divide-y divide-slate-100">
            @forelse($donasiTerbaru as $item)
                <a href="{{ route('pengelola.donasi.show', $item->id_donasi) }}" class="p-5 flex items-center justify-between gap-4 hover:bg-slate-50">
                    <div class="min-w-0">
                        <p class="font-bold truncate">{{ $item->nama_donatur ?? 'Donatur' }}</p>
                        <p class="text-sm text-slate-500 truncate">{{ $item->judul_kampanye ?? 'Kampanye' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-[#3525cd] whitespace-nowrap">Rp {{ number_format($item->nominal, 0, ',', '.') }}</p>
                        <x-pengelola-status :status="$item->status_donasi" />
                    </div>
                </a>
            @empty
                <div class="p-8 text-center text-slate-500">Belum ada donasi.</div>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-display font-bold text-lg">Kampanye Terbaru</h2>
            <a href="{{ route('pengelola.kampanye.index') }}" class="text-sm font-bold text-[#3525cd]">Kelola</a>
        </div>
        <div class="divide-y divide-slate-100">
            @forelse($kampanyeTerbaru as $item)
                <a href="{{ route('pengelola.kampanye.show', $item->id_kampanye) }}" class="p-5 block hover:bg-slate-50">
                    <div class="flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <p class="font-bold truncate">{{ $item->judul_kampanye }}</p>
                            <p class="text-sm text-slate-500 truncate">{{ $item->nama_penerima ?? 'Penerima' }}</p>
                        </div>
                        <x-pengelola-status :status="$item->status" />
                    </div>
                    <div class="mt-3 h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-[#3525cd]" style="width: {{ min(100, ($item->target_donasi > 0 ? ($item->terkumpul / $item->target_donasi) * 100 : 0)) }}%"></div>
                    </div>
                </a>
            @empty
                <div class="p-8 text-center text-slate-500">Belum ada kampanye.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
