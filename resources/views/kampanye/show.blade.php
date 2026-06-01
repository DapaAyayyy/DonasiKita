@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white border-2 border-black p-6 md:p-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <div>
            <img src="https://via.placeholder.com/600x400" alt="Detail Kampanye" class="w-full border-2 border-black object-cover aspect-video">
        </div>

        <div class="flex flex-col gap-4">
            
            <div class="bg-gray-300 px-3 py-2 border-2 border-black inline-block w-fit mb-2">
                <h1 class="text-xl md:text-2xl font-black text-black">{{ $detail->judul }}</h1>
            </div>
            
            <div class="bg-gray-200 p-4 border border-black flex flex-col gap-2">
                <p class="text-sm text-black"><strong>Penerima Manfaat:</strong> <br> {{ $detail->penerima->nama ?? 'Data tidak tersedia' }}</p>
                <div class="h-px w-full bg-black my-1"></div>
                <p class="text-sm text-black"><strong>Target Donasi:</strong> <br> Rp {{ number_format($detail->target_donasi, 0, ',', '.') }}</p>
                <p class="text-sm text-black"><strong>Dana Terkumpul:</strong> <br> Rp {{ number_format($detail->terkumpul, 0, ',', '.') }}</p>
            </div>

            <div>
                <div class="flex justify-between text-xs mb-1 font-bold text-black">
                    <span>Progress Donasi</span>
                    <span>{{ $detail->target_donasi > 0 ? number_format(min(($detail->terkumpul / $detail->target_donasi) * 100, 100), 0) : 0 }}%</span>
                </div>
                <div class="w-full border border-black bg-gray-100 h-6">
                    <div class="bg-green-500 h-full border-r border-black" 
                         style="width: {{ $detail->target_donasi > 0 ? min(($detail->terkumpul / $detail->target_donasi) * 100, 100) : 0 }}%;">
                    </div>
                </div>
            </div>

            <button class="mt-auto w-full bg-black text-white text-lg font-bold py-3 hover:bg-gray-800 transition border-2 border-black cursor-pointer">
                Sumbang Sekarang
            </button>
        </div>
    </div>
</div>
@endsection