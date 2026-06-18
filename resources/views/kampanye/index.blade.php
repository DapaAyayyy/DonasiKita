@extends('layouts.app')

@section('content')
<div class="max-w-container-max mx-auto px-gutter pt-[120px] pb-xl">

    <div class="flex flex-col items-center text-center mb-lg">
        <h2 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Semua Kampanye</h2>
        <div class="h-1 w-16 bg-[#84cc16] rounded-full mb-sm"></div>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl">Temukan dan bantu mereka yang membutuhkan. Setiap donasi, sekecil apapun, sangat berarti.</p>
    </div>

    @php
        $kategoriAktif = $kategori ?? '';
        $searchAktif = $search ?? '';
        $kategoriOptions = [
            '' => 'Semua',
            'bencana' => 'Bencana',
            'pendidikan' => 'Pendidikan',
            'kesehatan' => 'Kesehatan',
        ];
    @endphp

    <div class="flex flex-col md:flex-row justify-between items-center gap-md mb-lg">
        <div class="flex flex-wrap gap-sm justify-center md:justify-start">
            @foreach ($kategoriOptions as $value => $label)
                @php
                    $queryParams = array_filter([
                        'kategori' => $value !== '' ? $value : null,
                        'q' => $searchAktif !== '' ? $searchAktif : null,
                    ]);
                    $isActive = $kategoriAktif === $value;
                @endphp
                <a href="{{ url('/kampanye') }}{{ count($queryParams) ? '?' . http_build_query($queryParams) : '' }}"
                   class="px-md py-xs font-label-md text-label-md rounded-full transition-colors {{ $isActive ? 'bg-primary text-on-primary shadow-sm' : 'bg-surface-container text-on-surface-variant hover:bg-surface-container-high' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
        <form action="{{ url('/kampanye') }}" method="GET" class="relative w-full md:w-auto">
            @if ($kategoriAktif !== '')
                <input type="hidden" name="kategori" value="{{ $kategoriAktif }}">
            @endif
            <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-outline">search</span>
            <input name="q" value="{{ $searchAktif }}"
                   class="w-full md:w-64 pl-xl pr-sm py-sm bg-surface-container-lowest border border-outline-variant/50 rounded-full font-body-md text-body-md text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent shadow-sm"
                   placeholder="Cari kampanye..." type="text">
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-gutter">
        @forelse ($kampanye as $item)
            @php
                $target    = $item->target_donasi ?? 0;
                $terkumpul = $item->terkumpul ?? 0;
                $progress  = $target > 0 ? min(($terkumpul / $target) * 100, 100) : 0;
            @endphp

            <div class="bg-surface-container-lowest rounded-2xl shadow-soft-1 hover:shadow-soft-2 transition-shadow overflow-hidden flex flex-col group">
                <div class="relative h-48 overflow-hidden">
                    <img alt="{{ $item->judul_kampanye ?? 'Judul Tidak Tersedia' }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         src="{{ !empty($item->foto_sampul) ? asset('assets/images/' . $item->foto_sampul) : 'https://placehold.co/600x400?text=Belum+Ada+Sampul' }}">
                </div>

                <div class="p-md flex flex-col flex-grow">
                    <!-- 1. Judul Kampanye -->
                    <h3 class="font-headline-md text-[18px] md:text-[20px] font-bold text-on-surface mb-xs line-clamp-2">
                        {{ $kampanye->judul_kampanye ?? 'Judul Tidak Tersedia' }}
                    </h3>
                
                    <!-- 2. Nama Penerima (Dari Kode 2) -->
                    <p class="font-caption text-caption text-on-surface-variant flex items-center gap-xs mb-xs">
                        <span class="material-symbols-outlined text-[14px]">person</span>
                        <span><strong>Penerima:</strong> {{ $kampanye->penerima->nama ?? 'Data tidak tersedia' }}</span>
                    </p>
                
                    <!-- 3. Deskripsi Singkat (Dari Kode 1) -->
                    <p class="font-body-md text-body-md text-on-surface-variant mb-md line-clamp-2 text-[14px]">
                        {{ Str::limit($kampanye->deskripsi ?? 'Belum ada deskripsi.', 100) }}
                    </p>
                    
                    <!-- 4. Bagian Bawah: Progress, Target, dan Tombol -->
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
                <p class="font-headline-md text-headline-md text-on-surface-variant mb-xs">Belum ada kampanye</p>
                <p class="font-body-md text-body-md text-on-surface-variant text-center">Belum ada kampanye donasi saat ini.</p>
            </div>
        @endforelse
    </div>

    @if ($kampanye->hasPages())
        <div class="mt-lg">
            {{ $kampanye->links() }}
        </div>
    @endif
</div>
@endsection
