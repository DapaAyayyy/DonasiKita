@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    
    <div class="text-center mb-10">
        <h2 class="text-3xl font-black mb-1 teks-garis-hitam-tebal tracking-wide">Semua Kampanye</h2>
        <p class="text-sm text-black font-medium">Temukan dan bantu mereka yang membutuhkan</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($kampanye as $item)
            <div class="border-2 border-black bg-white w-full max-w-sm flex flex-col mx-auto">
                <img src="https://via.placeholder.com/400x250" alt="Thumbnail Kampanye" class="w-full h-48 object-cover border-b-2 border-black">
                <div class="p-4 flex flex-col gap-3">
                    
                    <div class="bg-gray-300 px-2 py-1 border border-transparent">
                        <h3 class="font-bold text-black text-sm truncate">{{ $item->judul }}</h3>
                    </div>
                    
                    <div class="text-xs text-black flex flex-col gap-1">
                        <p><strong>Penerima:</strong> {{ $item->penerima->nama ?? 'Data tidak tersedia' }}</p>
                        <p><strong>Target:</strong> Rp {{ number_format($item->target_donasi, 0, ',', '.') }}</p>
                        <p><strong>Terkumpul:</strong> Rp {{ number_format($item->terkumpul, 0, ',', '.') }}</p>
                    </div>
                    
                    <div class="mt-1">
                        <div class="w-full border border-black bg-gray-100 h-3">
                            <div class="bg-green-500 h-full border-r border-black" 
                                 style="width: {{ $item->target_donasi > 0 ? min(($item->terkumpul / $item->target_donasi) * 100, 100) : 0 }}%;">
                            </div>
                        </div>
                        <div class="flex justify-between text-[10px] mt-1 text-black font-medium">
                            <span>Progress</span>
                            <span>{{ $item->target_donasi > 0 ? number_format(min(($item->terkumpul / $item->target_donasi) * 100, 100), 0) : 0 }}%</span>
                        </div>
                    </div>
                    
                    <a href="/kampanye/{{ $item->id }}" class="mt-2 w-full bg-gray-300 border-2 border-black py-2 text-center text-sm font-bold text-black hover:bg-gray-400 transition-colors">
                        Donasi Sekarang
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-10 border-2 border-dashed border-gray-400">
                <p class="text-lg font-bold text-gray-500">Belum ada kampanye donasi saat ini.</p>
                <p class="text-sm text-gray-400">Jadilah yang pertama memulai kebaikan ketika kampanye tersedia!</p>
            </div>
        @endforelse
    </div>
</div>
@endsection