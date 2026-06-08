@extends('layouts.app')

@section('content')
@php
    $detail = $kampanye;
@endphp
<div class="max-w-container-max mx-auto px-gutter pt-[120px] pb-xl">

    <div class="flex items-center gap-xs mb-lg font-caption text-caption text-on-surface-variant">
        <a href="/" class="hover:text-primary transition-colors flex items-center gap-xs">
            <span class="material-symbols-outlined text-[16px]">home</span> Beranda
        </a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <a href="/kampanye" class="hover:text-primary transition-colors">Kampanye</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <span class="text-on-surface font-semibold truncate max-w-[240px]">{{ $detail->judul_kampanye ?? 'Judul Tidak Tersedia' }}</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-lg">

        <div class="lg:col-span-3 flex flex-col gap-md">
            
            <div class="rounded-2xl overflow-hidden shadow-soft-1">
                <img src="{{ !empty($detail->foto_sampul) ? asset('assets/images/' . $detail->foto_sampul) : 'https://placehold.co/600x400?text=Belum+Ada+Sampul' }}"
                     alt="{{ $detail->judul_kampanye ?? 'Judul Tidak Tersedia' }}"
                     class="w-full object-cover aspect-video">
            </div>

            <div class="bg-surface-container-lowest rounded-2xl shadow-soft-1 p-md">
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm flex items-center gap-xs">
                    <span class="material-symbols-outlined text-primary">description</span>
                    Tentang Kampanye
                </h2>
                <div class="h-px w-full bg-outline-variant/30 mb-sm"></div>
                <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                    {{ $detail->deskripsi ?? 'Belum ada deskripsi untuk kampanye ini.' }}
                </p>
            </div>

            <div class="bg-surface-container-lowest rounded-2xl shadow-soft-1 p-md">
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm flex items-center gap-xs">
                    <span class="material-symbols-outlined text-tertiary">article</span>
                    Laporan Perkembangan
                </h2>
                <div class="h-px w-full bg-outline-variant/30 mb-sm"></div>

                @if(isset($detail->laporan) && $detail->laporan->count() > 0)
                    <div class="flex flex-col gap-sm">
                        @foreach($detail->laporan as $laporan)
                            @php
                                $tanggalLaporan = !empty($laporan->tanggal_dibuat)
                                    ? \Carbon\Carbon::parse($laporan->tanggal_dibuat)->format('d M Y')
                                    : '';
                            @endphp
                            <article class="p-sm bg-surface-container-low rounded-xl border border-outline-variant/20">
                                <div class="flex items-start justify-between gap-sm mb-xs">
                                    <h3 class="font-label-md text-label-md text-on-surface">
                                        {{ $laporan->judul_laporan ?? 'Laporan Kampanye' }}
                                    </h3>
                                    @if($tanggalLaporan)
                                        <span class="font-caption text-caption text-on-surface-variant whitespace-nowrap">
                                            {{ $tanggalLaporan }}
                                        </span>
                                    @endif
                                </div>

                                @if(!empty($laporan->isi_laporan))
                                    <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed whitespace-pre-line">
                                        {{ $laporan->isi_laporan }}
                                    </p>
                                @else
                                    <p class="font-body-md text-body-md text-on-surface-variant">
                                        Belum ada detail laporan.
                                    </p>
                                @endif

                                @if(!empty($laporan->file_lampiran))
                                    <a href="{{ asset('assets/images/' . $laporan->file_lampiran) }}"
                                       target="_blank"
                                       class="inline-flex items-center gap-xs mt-sm font-label-md text-label-md text-primary hover:underline">
                                        <span class="material-symbols-outlined text-[18px]">attach_file</span>
                                        Lihat lampiran
                                    </a>
                                @endif
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center py-md text-outline-variant">
                        <span class="material-symbols-outlined text-[48px] mb-xs">article</span>
                        <p class="font-body-md text-body-md text-on-surface-variant">Belum ada laporan perkembangan.</p>
                        <p class="font-caption text-caption text-on-surface-variant">Laporan akan tampil setelah pengelola mempublikasikannya.</p>
                    </div>
                @endif
            </div>

            <div class="bg-surface-container-lowest rounded-2xl shadow-soft-1 p-md">
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm flex items-center gap-xs">
                    <span class="material-symbols-outlined text-secondary">history</span>
                    Riwayat Donasi
                </h2>
                <div class="h-px w-full bg-outline-variant/30 mb-sm"></div>

                @if(isset($detail->donasi) && $detail->donasi->count() > 0)
                    <div class="flex flex-col gap-sm">
                        @foreach($detail->donasi as $donatur)
                            @php
                                $namaDonatur = $donatur->donatur->nama ?? 'Hamba Allah';
                            @endphp
                            <div class="flex items-center justify-between p-sm bg-surface-container rounded-xl">
                                <div class="flex items-center gap-sm">
                                    <div class="w-10 h-10 rounded-full bg-primary-container/20 flex items-center justify-center text-primary font-bold text-sm flex-shrink-0">
                                        {{ strtoupper(substr($namaDonatur, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-label-md text-label-md text-on-surface">{{ $namaDonatur }}</p>
                                        <span class="font-caption text-caption px-xs py-[2px] rounded-full
                                            {{ ($donatur->status_donasi ?? '') === 'berhasil' ? 'bg-tertiary-container/20 text-tertiary' : 'bg-surface-container-high text-on-surface-variant' }}">
                                            {{ ucfirst($donatur->status_donasi ?? 'Pending') }}
                                        </span>
                                    </div>
                                </div>
                                <p class="font-label-md text-label-md text-primary font-bold">
                                    Rp {{ number_format($donatur->nominal ?? 0, 0, ',', '.') }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <p class="font-caption text-caption text-on-surface-variant mt-sm">
                        Menampilkan {{ $detail->donasi->count() }} dari {{ $totalRiwayatDonasi ?? $detail->donasi->count() }} donasi terbaru.
                    </p>
                @else
                    <div class="flex flex-col items-center py-md text-outline-variant">
                        <span class="material-symbols-outlined text-[48px] mb-xs">inbox</span>
                        <p class="font-body-md text-body-md text-on-surface-variant">Belum ada donasi untuk kampanye ini.</p>
                        <p class="font-caption text-caption text-on-surface-variant">Jadilah donatur pertama!</p>
                    </div>
                @endif
            </div>

            <div class="bg-surface-container-lowest rounded-2xl shadow-soft-1 p-md">
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm flex items-center gap-xs">
                    <span class="material-symbols-outlined text-primary">forum</span>
                    Dukungan Donatur
                </h2>
                <div class="h-px w-full bg-outline-variant/30 mb-sm"></div>

                @if(isset($feedbacks) && $feedbacks->count() > 0)
                    <div class="flex flex-col gap-sm">
                        @foreach($feedbacks as $feedback)
                            @php
                                $namaDonatur = $feedback->donasi->donatur->nama ?? 'Donatur';
                                $tanggal = !empty($feedback->tanggal_feedback)
                                    ? \Carbon\Carbon::parse($feedback->tanggal_feedback)->format('d M Y')
                                    : '';
                            @endphp
                            <div class="p-sm bg-surface-container-low rounded-xl border border-outline-variant/20">
                                <div class="flex items-center gap-sm mb-xs">
                                    <div class="w-8 h-8 rounded-full bg-primary-container/20 flex items-center justify-center text-primary font-bold text-xs flex-shrink-0">
                                        {{ strtoupper(substr($namaDonatur, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-label-md text-label-md text-on-surface">{{ $namaDonatur }}</p>
                                        <p class="font-caption text-caption text-on-surface-variant">{{ $tanggal }}</p>
                                    </div>
                                </div>
                                <p class="font-body-md text-body-md text-on-surface-variant italic">
                                    "{{ $feedback->komentar }}"
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <p class="font-caption text-caption text-on-surface-variant mt-sm">
                        Menampilkan {{ $feedbacks->count() }} dari {{ $totalDukungan ?? $feedbacks->count() }} dukungan terbaru.
                    </p>
                @else
                    <div class="flex flex-col items-center py-md text-outline-variant">
                        <span class="material-symbols-outlined text-[48px] mb-xs">chat_bubble_outline</span>
                        <p class="font-body-md text-body-md text-on-surface-variant">Belum ada pesan dukungan.</p>
                        <p class="font-caption text-caption text-on-surface-variant">Berikan dukunganmu saat melakukan donasi!</p>
                    </div>
                @endif
            </div>

        </div>

        <div class="lg:col-span-2">
            <div class="bg-surface-container-lowest rounded-2xl shadow-soft-1 p-md sticky top-[100px]">
                
                <h1 class="font-headline-lg text-headline-lg text-on-surface mb-md leading-snug">{{ $detail->judul_kampanye ?? 'Judul Tidak Tersedia' }}</h1>

                <div class="flex items-center gap-sm mb-md p-sm bg-surface-container rounded-xl">
                    <div class="w-10 h-10 rounded-full bg-secondary-container/20 flex items-center justify-center text-secondary font-bold flex-shrink-0">
                        {{ strtoupper(substr($detail->penerima->nama ?? 'P', 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-caption text-caption text-on-surface-variant uppercase tracking-wide">Penerima Manfaat</p>
                        <p class="font-label-md text-label-md text-on-surface">{{ $detail->penerima->nama ?? 'Data tidak tersedia' }}</p>
                    </div>
                </div>

                @php
                    $target    = $detail->target_donasi ?? 0;
                    $terkumpul = $detail->terkumpul ?? 0;
                    $progress  = $target > 0 ? min(($terkumpul / $target) * 100, 100) : 0;
                @endphp

                <div class="mb-md">
                    <div class="flex justify-between items-end mb-xs">
                        <div>
                            <p class="font-caption text-caption text-on-surface-variant">Dana Terkumpul</p>
                            <p class="font-headline-md text-headline-md text-primary font-bold">Rp {{ number_format($terkumpul, 0, ',', '.') }}</p>
                        </div>
                        <span class="font-label-md text-label-md text-on-surface-variant bg-surface-container px-sm py-xs rounded-full">
                            {{ number_format($progress, 0) }}%
                        </span>
                    </div>
                    <div class="w-full h-3 bg-surface-container-high rounded-full overflow-hidden mb-xs">
                        <div class="h-full bg-progress-gradient rounded-full transition-all duration-700"
                             style="width: {{ $progress }}%;"></div>
                    </div>
                    <div class="flex justify-between font-caption text-caption text-on-surface-variant">
                        <span>dari target</span>
                        <span class="font-semibold text-on-surface">Rp {{ number_format($target, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="h-px w-full bg-outline-variant/30 mb-md"></div>

                {{-- CEK APAKAH YANG LOGIN ADALAH DONATUR --}}
                @if(session('auth_type') === 'donatur')
                    <form action="{{ route('donasi.store', $detail->id_kampanye) }}" method="POST" class="mb-sm">
                        @csrf
                        
                        <label for="nominal" class="block font-label-md text-label-md text-on-surface mb-xs">
                            Nominal Donasi
                        </label>
                        <input
                            type="number"
                            id="nominal"
                            name="nominal"
                            min="10000"
                            step="1000"
                            value="{{ old('nominal') }}"
                            placeholder="Masukkan nominal donasi (Min. 10.000)"
                            required
                            class="w-full px-sm py-sm mb-sm rounded-xl border border-outline-variant bg-surface-container-lowest text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary/40"
                        >
                        @error('nominal')
                            <p class="font-caption text-caption text-error -mt-sm mb-sm">{{ $message }}</p>
                        @enderror

                        <label for="komentar" class="block font-label-md text-label-md text-on-surface mb-xs">
                            Pesan dukungan (opsional)
                        </label>
                        <textarea
                            id="komentar"
                            name="komentar"
                            rows="3"
                            placeholder="Tulis doa atau dukungan untuk kampanye ini..."
                            class="w-full px-sm py-sm mb-md rounded-xl border border-outline-variant bg-surface-container-lowest text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary/40 resize-none"
                        >{{ old('komentar') }}</textarea>
                        @error('komentar')
                            <p class="font-caption text-caption text-error -mt-md mb-md">{{ $message }}</p>
                        @enderror

                        <button type="submit" class="w-full py-sm bg-primary text-on-primary font-label-md text-label-md rounded-full shadow-soft-1 hover:shadow-soft-2 hover:opacity-90 transition-all active:scale-95 flex justify-center items-center gap-xs text-[16px]">
                            <span class="material-symbols-outlined fill">favorite</span> Sumbang Sekarang
                        </button>
                    </form>
                @else
                    <div class="mb-sm rounded-2xl border border-outline-variant bg-surface-container p-sm text-center">
                        <span class="material-symbols-outlined text-primary text-[32px] mb-xs">login</span>
                        <p class="font-label-md text-label-md text-on-surface mb-xs">
                            Login sebagai donatur untuk berdonasi.
                        </p>
                        <p class="font-caption text-caption text-on-surface-variant mb-sm">
                            @if(session('auth_type') === 'pengelola')
                                Akun pengelola tidak dapat melakukan donasi.
                            @else
                                Masuk terlebih dahulu agar donasi tercatat di riwayat akunmu.
                            @endif
                        </p>
                        <a href="/login"
                           class="w-full py-sm bg-primary text-on-primary font-label-md text-label-md rounded-full shadow-soft-1 hover:shadow-soft-2 hover:opacity-90 transition-all flex justify-center items-center gap-xs">
                            <span class="material-symbols-outlined text-[18px]">login</span> Login untuk Berdonasi
                        </a>
                    </div>
                @endif

                <a href="/kampanye"
                   class="w-full py-sm border border-outline-variant text-on-surface-variant font-label-md text-label-md rounded-full hover:bg-surface-container transition-colors flex justify-center items-center gap-xs mt-xs">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali ke Daftar
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
