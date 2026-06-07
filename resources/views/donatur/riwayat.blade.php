@extends('layouts.app')

@section('title', 'Riwayat Donasi - DonasiKita')

@section('content')
<div class="max-w-container-max mx-auto px-gutter pt-[120px] pb-xl min-h-[80vh]">

    <!-- Header Section -->
    <div class="flex flex-col items-center text-center mb-lg">
        <h2 class="font-['Plus_Jakarta_Sans'] text-[32px] font-bold text-on-surface mb-xs">Riwayat Donasi Saya</h2>
        <div class="h-1 w-16 bg-[#84cc16] rounded-full mb-sm"></div>
        <p class="text-[16px] text-on-surface-variant max-w-2xl">Lacak jejak kebaikanmu. Terima kasih telah menjadi bagian dari perubahan nyata.</p>
    </div>

    <!-- Container Card List -->
    <div class="max-w-4xl mx-auto flex flex-col gap-4">
        
        {{-- Kita asumsikan Backend 1 melempar variabel $riwayat ke view ini --}}
        @forelse ($riwayat as $item)
            @php
                // Logika Warna Badge Status
                $status = strtolower($item->status_donasi ?? 'pending');
                if ($status == 'berhasil') {
                    $badgeBg = 'bg-green-100';
                    $badgeText = 'text-green-800';
                    $icon = 'check_circle';
                } elseif ($status == 'pending') {
                    $badgeBg = 'bg-yellow-100';
                    $badgeText = 'text-yellow-800';
                    $icon = 'schedule';
                } else {
                    $badgeBg = 'bg-red-100';
                    $badgeText = 'text-red-800';
                    $icon = 'cancel';
                }
            @endphp

            <!-- Card Item Transaksi -->
            <div class="bg-surface-container-lowest rounded-2xl p-5 md:p-6 shadow-soft-1 hover:shadow-soft-2 border border-outline-variant/30 transition-all flex flex-col md:flex-row md:items-center justify-between gap-4 group">
                
                <!-- Kiri: Info Kampanye & Tanggal -->
                <div class="flex items-start md:items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                        <span class="material-symbols-outlined fill text-[24px]">favorite</span>
                    </div>
                    <div>
                        {{-- Mengambil nama kampanye dari relasi Backend 1 --}}
                        <h3 class="font-['Plus_Jakarta_Sans'] text-[18px] font-bold text-on-surface mb-1 group-hover:text-primary transition-colors line-clamp-1">
                            {{ $item->kampanye->judul ?? 'Nama Kampanye Tidak Ditemukan' }}
                        </h3>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-[14px] text-on-surface-variant">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                {{ \Carbon\Carbon::parse($item->tanggal_donasi)->translatedFormat('d F Y, H:i') }}
                            </span>
                            <span class="hidden md:inline text-outline-variant">•</span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">account_balance_wallet</span>
                                {{-- Mengambil metode pembayaran dari relasi Backend 1 --}}
                                {{ $item->metodePembayaran->nama_metode ?? $item->payment_type ?? 'Midtrans' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Nominal & Status -->
                <div class="flex flex-row md:flex-col items-center md:items-end justify-between md:justify-center border-t md:border-t-0 border-outline-variant/20 pt-4 md:pt-0 mt-2 md:mt-0">
                    <p class="font-['Plus_Jakarta_Sans'] text-[20px] font-extrabold text-primary mb-1">
                        Rp {{ number_format($item->nominal ?? 0, 0, ',', '.') }}
                    </p>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[13px] font-semibold tracking-wide {{ $badgeBg }} {{ $badgeText }}">
                        <span class="material-symbols-outlined text-[14px]">{{ $icon }}</span>
                        {{ ucfirst($status) }}
                    </span>
                </div>
            </div>

        @empty
            <!-- Empty State (Jika belum ada riwayat donasi) -->
            <div class="flex flex-col items-center justify-center py-16 px-4 text-center bg-surface-container-lowest rounded-3xl border border-dashed border-outline-variant shadow-sm">
                <div class="w-24 h-24 bg-surface-container rounded-full flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-[48px] text-primary/50">receipt_long</span>
                </div>
                <h3 class="font-['Plus_Jakarta_Sans'] text-[24px] font-bold text-on-surface mb-2">Belum Ada Riwayat</h3>
                <p class="text-[16px] text-on-surface-variant max-w-md mb-6">Kamu belum melakukan donasi apapun. Yuk, mulai tebarkan kebaikan pertamamu hari ini!</p>
                <a href="/kampanye" class="px-8 py-3 bg-primary text-white font-semibold rounded-full hover:bg-[#2A1B9A] shadow-soft-1 hover:shadow-soft-2 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">search</span> Cari Kampanye
                </a>
            </div>
        @endforelse

    </div>
</div>
@endsection
