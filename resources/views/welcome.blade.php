@extends('layouts.app')

@section('content')
    <!-- HERO SECTION -->
    <div class="relative w-full h-[400px] mb-10">
        <!-- Background Image -->
        <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&q=80&w=1200" 
             class="absolute inset-0 w-full h-full object-cover" alt="Hero Background">
        
        <!-- Konten Teks -->
        <div class="relative z-10 p-10 md:p-14 h-full flex flex-col justify-center max-w-3xl">
            <h1 class="text-4xl md:text-5xl font-black mb-4 teks-garis-hitam-tebal tracking-wide leading-tight">
                Bantuan sekecil apapun sangat berarti bagi yang membutuhkan
            </h1>
            <p class="text-xl font-bold mb-8 teks-garis-hitam tracking-wide">
                Mulailah berdonasi bersama kami
            </p>
            <div>
                <a href="/kampanye" class="bg-black text-white px-6 py-3 text-sm font-bold hover:bg-gray-800 transition">
                    Mulai Berdonasi
                </a>
            </div>
        </div>
    </div>

    <!-- STATISTIK SECTION (Kotak Abu-abu) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
        <!-- Box 1 -->
        <div class="bg-[#e5e5e5] py-8 px-6 flex flex-col items-center justify-center border border-gray-200">
            <div class="text-3xl mb-4">📁</div>
            <div class="bg-[#a3a3a3] text-black text-xs font-bold w-4/5 text-center py-1 border border-gray-400 mb-2">
                20
            </div>
            <div class="text-xs text-black">Kampanye Aktif</div>
        </div>
        
        <!-- Box 2 -->
        <div class="bg-[#e5e5e5] py-8 px-6 flex flex-col items-center justify-center border border-gray-200">
            <div class="text-3xl mb-4">👤</div>
            <div class="bg-[#a3a3a3] text-black text-xs font-bold w-4/5 text-center py-1 border border-gray-400 mb-2">
                50.000
            </div>
            <div class="text-xs text-black">Donatur Terdaftar</div>
        </div>
        
        <!-- Box 3 -->
        <div class="bg-[#e5e5e5] py-8 px-6 flex flex-col items-center justify-center border border-gray-200">
            <div class="text-3xl mb-4">💵</div>
            <div class="bg-[#a3a3a3] text-black text-xs font-bold w-4/5 text-center py-1 border border-gray-400 mb-2">
                Rp 5.000.000.000
            </div>
            <div class="text-xs text-black">Dana Terkumpul</div>
        </div>
    </div>

    <!-- SEARCH BAR -->
    <div class="max-w-lg mx-auto mb-16 relative">
        <input type="text" 
               placeholder="Cari Donasi yang ingin kamu bantu" 
               class="w-full bg-[#e5e5e5] border border-black rounded-full py-3 pl-6 pr-12 text-sm text-black italic focus:outline-none placeholder-gray-600">
        <button class="absolute right-4 top-1/2 -translate-y-1/2 text-black font-bold text-lg">
            🔍
        </button>
    </div>

    <!-- LIST KAMPANYE HEADER -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-black teks-garis-hitam-tebal mb-1 tracking-wide">List Kampanye</h2>
        <p class="text-xs text-black font-medium">Mulailah berdonasi bersama kami</p>
    </div>

    <!-- WADAH FRONTEND 2 (MURNI KOSONG) -->
    <div class="border border-dashed border-gray-400 py-20 text-center">
        <p class="text-sm text-gray-500 font-bold">🚧 Area Frontend 2 (Silakan Isi Card Kampanye Di Sini) 🚧</p>
    </div>
@endsection