@extends('layouts.app') 

@section('title', 'DonasiKita - Kebaikan Dimulai Dari Sini')

@section('content')
    <section class="relative pt-[120px] pb-xl lg:pt-[160px] lg:pb-[120px] bg-hero-gradient overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="max-w-container-max mx-auto px-gutter relative z-10 flex flex-col items-center text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-surface-container-lowest/20 backdrop-blur-md rounded-full mb-md animate-fade-in-up">
                <span class="material-symbols-outlined fill text-[#84cc16] text-sm">verified</span>
                <span class="font-label-md text-label-md text-surface-container-lowest">Platform Donasi Terpercaya</span>
            </div>
            <h1 class="font-display-lg text-display-lg text-surface-container-lowest mb-md max-w-4xl">Kebaikan Dimulai <br class="hidden md:block"> Dari Sini</h1>
            <p class="font-body-lg text-body-lg text-surface-container-lowest/90 mb-lg max-w-2xl">
                Platform donasi terpercaya untuk membantu sesama yang membutuhkan. Bersama, kita bisa menciptakan perubahan positif yang nyata bagi mereka yang kurang beruntung.
            </p>
            <a href="/kampanye" class="flex items-center gap-sm px-xl py-sm bg-surface-container-lowest text-primary font-label-md text-label-md text-[16px] rounded-full shadow-soft-2 hover:scale-105 transition-transform active:scale-95">
                <span class="material-symbols-outlined fill text-[#84cc16]">volunteer_activism</span>
                Mulai Berdonasi
            </a>
        </div>
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
            <svg class="relative block w-[calc(100%+1.3px)] h-[60px] md:h-[100px]" data-name="Layer 1" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
                <path class="fill-background" d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,121.32,190.8,111.4,233.15,104.38,278.47,75.49,321.39,56.44Z"></path>
            </svg>
        </div>
    </section>

    <section class="max-w-container-max mx-auto px-gutter -mt-xl relative z-20 mb-xl">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter bg-surface-container-lowest rounded-2xl shadow-soft-2 p-lg">
            <div class="flex flex-col items-center text-center p-md group">
                <div class="w-16 h-16 rounded-full bg-primary-container/10 flex items-center justify-center mb-sm group-hover:bg-primary-container/20 transition-colors">
                    <span class="material-symbols-outlined text-primary text-[32px]">campaign</span>
                </div>
                <h3 class="font-headline-lg text-headline-lg text-on-surface mb-xs">{{ number_format($totalKampanye ?? 0, 0, ',', '.') }}</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Kampanye Aktif</p>
            </div>
            <div class="flex flex-col items-center text-center p-md border-y md:border-y-0 md:border-x border-outline-variant/30 group">
                <div class="w-16 h-16 rounded-full bg-secondary-container/10 flex items-center justify-center mb-sm group-hover:bg-secondary-container/20 transition-colors">
                    <span class="material-symbols-outlined text-secondary text-[32px]">group</span>
                </div>
                <h3 class="font-headline-lg text-headline-lg text-on-surface mb-xs">{{ number_format($totalDonatur ?? 0, 0, ',', '.') }}</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Donatur Terdaftar</p>
            </div>
            <div class="flex flex-col items-center text-center p-md group">
                <div class="w-16 h-16 rounded-full bg-tertiary-container/10 flex items-center justify-center mb-sm group-hover:bg-tertiary-container/20 transition-colors">
                    <span class="material-symbols-outlined text-tertiary text-[32px]">account_balance_wallet</span>
                </div>
                <h3 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Rp {{ number_format($totalDana ?? 0, 0, ',', '.') }}</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Dana Terkumpul</p>
            </div>
        </div>
    </section>

    <section class="max-w-container-max mx-auto px-gutter mb-xl">
        <div class="flex flex-col items-center text-center mb-lg">
            <h2 class="font-display-lg text-headline-lg text-on-surface mb-xs">Kampanye Pilihan</h2>
            <div class="h-1 w-16 bg-[#84cc16] rounded-full mb-sm"></div>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl">Pilih kampanye yang ingin Anda dukung dan mulai berbagi kebaikan hari ini.</p>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center gap-md mb-lg">
            <div class="flex flex-wrap gap-sm justify-center md:justify-start">
                <a href="/kampanye" class="px-md py-xs bg-primary text-on-primary font-label-md text-label-md rounded-full shadow-sm">Semua</a>
                <a href="/kampanye?kategori=bencana" class="px-md py-xs bg-surface-container text-on-surface-variant hover:bg-surface-container-high font-label-md text-label-md rounded-full transition-colors">Bencana</a>
                <a href="/kampanye?kategori=pendidikan" class="px-md py-xs bg-surface-container text-on-surface-variant hover:bg-surface-container-high font-label-md text-label-md rounded-full transition-colors">Pendidikan</a>
                <a href="/kampanye?kategori=kesehatan" class="px-md py-xs bg-surface-container text-on-surface-variant hover:bg-surface-container-high font-label-md text-label-md rounded-full transition-colors">Kesehatan</a>
            </div>
            <form action="/kampanye" method="GET" class="relative w-full md:w-auto">
                <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-outline">search</span>
                <input name="q" class="w-full md:w-64 pl-xl pr-sm py-sm bg-surface-container-lowest border border-outline-variant/50 rounded-full font-body-md text-body-md text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent shadow-sm" placeholder="Cari kampanye..." type="text">
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-gutter">
            
            @forelse($kampanyes ?? [] as $kampanye)
                @php
                    $target = $kampanye->target_donasi ?? 0;
                    $terkumpul = $kampanye->terkumpul ?? 0;
                    $progress = $target > 0 ? min(($terkumpul / $target) * 100, 100) : 0;
                @endphp

                <div class="bg-surface-container-lowest rounded-2xl shadow-soft-1 hover:shadow-soft-2 transition-shadow overflow-hidden flex flex-col group">
                    <div class="relative h-48 overflow-hidden">
                        <img alt="{{ $kampanye->judul_kampanye ?? 'Kampanye' }}" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                            src="{{ !empty($kampanye->foto_sampul) ? asset('assets/images/' . $kampanye->foto_sampul) : 'https://placehold.co/600x400?text=Belum+Ada+Sampul' }}">
                        @if(($kampanye->status ?? '') === 'mendesak')
                            <div class="absolute top-sm right-sm px-sm py-xs text-white font-label-md text-label-md text-[12px] rounded-full shadow-sm flex items-center gap-xs bg-primary">
                                <span class="material-symbols-outlined text-[16px]">warning</span> Mendesak
                            </div>
                        @endif
                    </div>
                    <div class="p-md flex flex-col flex-grow">
                        <h3 class="font-headline-md text-[20px] font-bold text-on-surface mb-xs line-clamp-2">{{ $kampanye->judul_kampanye ?? 'Judul Tidak Tersedia' }}</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mb-md line-clamp-2 text-[14px]">{{ Str::limit($kampanye->deskripsi ?? 'Belum ada deskripsi.', 100) }}</p>
                        
                        <div class="mt-auto">
                            <div class="flex justify-between items-end mb-xs">
                                <span class="font-label-md text-label-md text-primary">Rp {{ number_format($terkumpul, 0, ',', '.') }}</span>
                                <span class="font-caption text-caption text-on-surface-variant">{{ number_format($progress, 0) }}%</span>
                            </div>
                            <div class="w-full h-2 bg-surface-container-high rounded-full mb-sm overflow-hidden">
                                <div class="h-full bg-progress-gradient rounded-full" style="width: {{ $progress }}%"></div>
                            </div>
                            <div class="flex justify-between items-center mb-md">
                                <div class="flex items-center gap-xs text-outline font-caption text-caption">
                                    <span class="material-symbols-outlined text-[16px]">track_changes</span> Target: Rp {{ number_format($target, 0, ',', '.') }}
                                </div>
                            </div>
                            <a href="/kampanye/{{ $kampanye->id_kampanye ?? '#' }}" class="w-full py-sm border border-primary text-primary font-label-md text-label-md rounded-full hover:bg-primary hover:text-on-primary transition-colors flex justify-center items-center gap-xs">
                                <span class="material-symbols-outlined fill text-[18px]">favorite</span> Donasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 xl:col-span-3 flex flex-col items-center justify-center py-xl text-outline-variant">
                    <span class="material-symbols-outlined text-[64px] mb-sm">inventory_2</span>
                    <p class="font-body-md text-body-md text-center">Belum ada kampanye yang tersedia saat ini.</p>
                </div>
            @endforelse

        </div>
        <div class="flex justify-center mt-lg">
            <a href="/kampanye" class="px-lg py-sm bg-surface-container text-primary font-label-md text-label-md rounded-full hover:bg-surface-container-high transition-colors">
                Lihat Semua Kampanye
            </a>
        </div>
    </section>
@endsection