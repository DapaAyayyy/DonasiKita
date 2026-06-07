@extends('layouts.app')

@section('title', 'Leaderboard - DonasiKita')

@section('content')
@php
    $leaderboard = collect($leaderboard ?? []);
    $podiumOrder = [
        ['index' => 1, 'height' => 'h-[110px] md:h-[150px]', 'badge' => 'bg-surface-container text-primary', 'width' => 'min-w-[110px] md:min-w-[160px]'],
        ['index' => 0, 'height' => 'h-[150px] md:h-[220px]', 'badge' => 'bg-[#FACC15] text-white', 'width' => 'min-w-[130px] md:min-w-[190px]'],
        ['index' => 2, 'height' => 'h-[90px] md:h-[120px]', 'badge' => 'bg-surface-container text-secondary', 'width' => 'min-w-[110px] md:min-w-[160px]'],
    ];
@endphp

<style>
    .podium-base {
        background: linear-gradient(180deg, #ffffff 0%, #e5eeff 100%);
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        box-shadow: inset 0 2px 5px rgba(255,255,255,1), 0 4px 6px rgba(0,0,0,0.05);
    }

    .rank-card {
        position: relative;
        z-index: 10;
        transform: translateY(12px);
    }
</style>

<section class="pt-[120px]">
    <div class="bg-hero-gradient pt-16 pb-[140px] rounded-b-[40px] md:rounded-b-[80px] relative overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="text-center px-6 relative z-10">
            <div class="inline-block bg-white/20 text-white backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold mb-4 border border-white/20 shadow-sm">
                Apresiasi Kebaikan
            </div>
            <h1 class="font-display-lg text-4xl md:text-5xl font-black text-white tracking-tight mb-4 drop-shadow-md">
                Leaderboard Donatur
            </h1>
            <p class="text-white/80 font-body-lg text-[15px] md:text-base max-w-xl mx-auto drop-shadow leading-relaxed">
                Inilah 10 donatur teratas berdasarkan total donasi berstatus berhasil.
            </p>
        </div>
    </div>

    <div class="max-w-container-max mx-auto px-gutter -mt-[80px] relative z-20 pb-xl">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 max-w-5xl mx-auto">
            <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-soft-1 border border-outline-variant/30 flex flex-col items-center md:items-start">
                <div class="p-3 bg-surface-container rounded-xl text-primary mb-3">
                    <span class="material-symbols-outlined">campaign</span>
                </div>
                <div class="font-headline-lg text-3xl text-on-background">{{ number_format($totalKampanye ?? 0, 0, ',', '.') }}</div>
                <span class="font-label-md text-on-surface-variant mt-1">Kampanye Aktif</span>
            </div>

            <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-soft-1 border border-outline-variant/30 flex flex-col items-center md:items-start">
                <div class="p-3 bg-green-50 rounded-xl text-green-600 mb-3">
                    <span class="material-symbols-outlined">group</span>
                </div>
                <div class="font-headline-lg text-3xl text-on-background">{{ number_format($totalDonatur ?? 0, 0, ',', '.') }}</div>
                <span class="font-label-md text-on-surface-variant mt-1">Donatur Terdaftar</span>
            </div>

            <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-soft-1 border border-outline-variant/30 flex flex-col items-center md:items-start">
                <div class="p-3 bg-surface-container rounded-xl text-primary mb-3">
                    <span class="material-symbols-outlined">account_balance_wallet</span>
                </div>
                <div class="font-headline-md lg:font-headline-lg text-2xl lg:text-3xl text-on-background">Rp {{ number_format($totalDana ?? 0, 0, ',', '.') }}</div>
                <span class="font-label-md text-on-surface-variant mt-1">Dana Berhasil Terkumpul</span>
            </div>
        </div>

        @if($leaderboard->isNotEmpty())
            <div class="flex flex-nowrap justify-center items-end gap-3 md:gap-6 mt-8 overflow-x-auto pb-10 w-full snap-x">
                @foreach($podiumOrder as $podium)
                    @php
                        $donatur = $leaderboard->get($podium['index']);
                        $rank = $podium['index'] + 1;
                    @endphp

                    @if($donatur)
                        <div class="flex flex-col items-center {{ $podium['width'] }} snap-center">
                            <div class="bg-surface-container-lowest p-4 rounded-2xl shadow-soft-1 flex flex-col items-center w-full rank-card border border-outline-variant/20 {{ $rank === 1 ? 'border-b-[5px] border-primary shadow-soft-2' : '' }}">
                                <div class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-primary-container/15 text-primary flex items-center justify-center font-display-lg text-2xl mb-3 border border-primary/10">
                                    {{ strtoupper(substr($donatur->nama ?? 'D', 0, 1)) }}
                                </div>
                                <div class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-bold {{ $podium['badge'] }} mb-2">
                                    <span class="material-symbols-outlined text-[16px] {{ $rank === 1 ? 'fill' : '' }}">emoji_events</span>
                                    #{{ $rank }}
                                </div>
                                <div class="font-label-md text-sm md:text-base text-on-background text-center w-full truncate px-1">
                                    {{ $donatur->nama }}
                                </div>
                                <div class="font-caption text-caption text-primary font-bold mt-1">
                                    Rp {{ number_format($donatur->total_donasi, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="w-[85%] {{ $podium['height'] }} podium-base border-x border-t border-outline-variant/30"></div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="max-w-4xl mx-auto mt-10 bg-surface-container-lowest rounded-3xl shadow-soft-1 border border-outline-variant/30 overflow-hidden">
                <div class="px-md py-sm border-b border-outline-variant/30 flex items-center gap-xs">
                    <span class="material-symbols-outlined text-primary">format_list_numbered</span>
                    <h2 class="font-headline-md text-headline-md text-on-background">Peringkat Donatur</h2>
                </div>

                <div class="divide-y divide-outline-variant/20">
                    @foreach($leaderboard as $index => $donatur)
                        <div class="flex items-center justify-between gap-md px-md py-sm hover:bg-surface-container-low transition-colors">
                            <div class="flex items-center gap-sm min-w-0">
                                <div class="w-10 h-10 rounded-full {{ $index < 3 ? 'bg-primary text-on-primary' : 'bg-surface-container text-primary' }} flex items-center justify-center font-bold flex-shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <div class="min-w-0">
                                    <p class="font-label-md text-label-md text-on-background truncate">{{ $donatur->nama }}</p>
                                    <p class="font-caption text-caption text-on-surface-variant">Total donasi berhasil</p>
                                </div>
                            </div>
                            <p class="font-label-md text-label-md text-primary font-bold whitespace-nowrap">
                                Rp {{ number_format($donatur->total_donasi, 0, ',', '.') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="max-w-3xl mx-auto bg-surface-container-lowest rounded-3xl border border-dashed border-outline-variant shadow-sm p-xl text-center">
                <span class="material-symbols-outlined text-[56px] text-primary/50 mb-sm">emoji_events</span>
                <h2 class="font-headline-md text-headline-md text-on-background mb-xs">Belum Ada Data Leaderboard</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Leaderboard akan muncul setelah ada donasi dengan status berhasil.
                </p>
                <a href="/kampanye" class="inline-flex items-center gap-xs mt-md px-lg py-sm bg-primary text-on-primary font-label-md text-label-md rounded-full shadow-soft-1 hover:shadow-soft-2 transition-all">
                    <span class="material-symbols-outlined fill text-[18px]">favorite</span>
                    Mulai Berdonasi
                </a>
            </div>
        @endif
    </div>
</section>
@endsection
