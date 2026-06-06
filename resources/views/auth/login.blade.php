<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - DonasiKita</title>
    <link rel="icon" href="{{ asset('assets/icons/donasikitaicon.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="flex min-h-screen bg-[#F8F9FA]">

    <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-[#1E2E81] via-[#2A3B9A] to-[#4339CA] p-16 flex-col justify-center text-white relative overflow-hidden">
        
        <div class="absolute top-[200px] left-14 flex items-center gap-3">
            <img src="{{ asset('assets/icons/donasikitaicon.png') }}" alt="Logo DonasiKita" class="h-20 w-auto drop-shadow-md">
        </div>

        <div class="z-10 mt-10">
            <h1 class="font-['Plus_Jakarta_Sans'] text-5xl lg:text-6xl font-extrabold leading-tight mb-6 drop-shadow-sm">
                Kebaikan Dimulai<br>Dari Sini
            </h1>
            <p class="text-lg text-blue-100 max-w-md leading-relaxed mb-12">
                Masuk dan lanjutkan kebaikanmu bersama kampanye sosial yang membutuhkan dukungan. Bersama kita bangun masa depan yang lebih peduli.
            </p>

            <div class="flex gap-8 text-sm font-medium text-blue-200">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.965 11.965 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    Aman & Terpercaya
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Donasi Transparan
                </div>
            </div>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex flex-col relative p-8">
        
        <a href="/" class="absolute top-8 left-8 flex items-center gap-2 text-sm text-[#2A3B9A] font-semibold hover:underline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Beranda
        </a>

        <div class="m-auto w-full max-w-[420px] bg-white rounded-3xl p-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
            <h2 class="font-['Plus_Jakarta_Sans'] text-3xl font-extrabold text-[#0B132A] mb-2 tracking-tight" id="login-title">Masuk ke DonasiKita</h2>
            <p class="text-sm text-gray-500 mb-8 leading-relaxed" id="login-subtitle">Lanjutkan kebaikanmu dan bantu kampanye yang membutuhkan.</p>

            <div class="flex bg-gray-50 rounded-full p-1.5 mb-8">
                <button type="button" id="tab-donatur" onclick="switchTab('donatur')" class="flex-1 bg-[#0A192F] text-white font-semibold py-2.5 rounded-full text-sm shadow-sm transition-colors">Donatur</button>
                <button type="button" id="tab-pengelola" onclick="switchTab('pengelola')" class="flex-1 text-gray-500 font-medium py-2.5 rounded-full text-sm hover:text-gray-700 transition-colors">Pengelola</button>
            </div>

            <form action="#" method="POST" id="form-donatur" class="flex flex-col gap-5">
                @csrf
                <input type="hidden" name="role" value="donatur">
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Email Donatur</label>
                    <input type="email" name="email" placeholder="nama@email.com" required class="w-full px-5 py-3.5 rounded-full border border-gray-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm placeholder-gray-400 transition-shadow">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-bold text-gray-700">Password</label>
                        <a href="#" class="text-xs text-[#4339CA] font-medium hover:underline">Lupa password?</a>
                    </div>
                    <div class="relative">
                        <input type="password" name="password" placeholder="••••••••" required class="w-full px-5 py-3.5 rounded-full border border-gray-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm placeholder-gray-400 transition-shadow">
                    </div>
                </div>

                <button type="submit" class="mt-4 w-full bg-[#5A4BFF] hover:bg-[#4a3ce0] text-white font-semibold py-4 rounded-full flex justify-center items-center gap-2 transition-colors">
                    Masuk 
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                </button>

                <div class="mt-4 text-center text-sm text-gray-500">
                    Belum punya akun? <a href="/register" class="text-[#0B132A] font-semibold hover:underline">Daftar sebagai Donatur</a>
                </div>
            </form>

            <form action="#" method="POST" id="form-pengelola" class="hidden flex-col gap-5">
                @csrf
                <input type="hidden" name="role" value="admin">
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">ID Pengelola / Email</label>
                    <input type="text" name="email" placeholder="admin@donasikita.com" required class="w-full px-5 py-3.5 rounded-full border border-gray-200 focus:outline-none focus:border-[#0A192F] focus:ring-1 focus:ring-[#0A192F] text-sm placeholder-gray-400 transition-shadow">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-bold text-gray-700">Password Akses</label>
                    </div>
                    <div class="relative">
                        <input type="password" name="password" placeholder="••••••••" required class="w-full px-5 py-3.5 rounded-full border border-gray-200 focus:outline-none focus:border-[#0A192F] focus:ring-1 focus:ring-[#0A192F] text-sm placeholder-gray-400 transition-shadow">
                    </div>
                </div>

                <button type="submit" class="mt-4 w-full bg-[#0A192F] hover:bg-black text-white font-semibold py-4 rounded-full flex justify-center items-center gap-2 transition-colors">
                    Akses Dashboard 
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </button>

                <div class="mt-4 text-center text-sm text-gray-500">
                    Hanya untuk pengurus dan admin terdaftar.
                </div>
            </form>

        </div>
    </div>

    <script>
        function switchTab(tab) {
            // Mengambil elemen tombol
            const tabDonatur = document.getElementById('tab-donatur');
            const tabPengelola = document.getElementById('tab-pengelola');
            
            // Mengambil elemen formulir
            const formDonatur = document.getElementById('form-donatur');
            const formPengelola = document.getElementById('form-pengelola');
            
            // Mengambil elemen teks judul
            const title = document.getElementById('login-title');
            const subtitle = document.getElementById('login-subtitle');

            // Class untuk kondisi aktif dan non-aktif
            const activeClasses = ['bg-[#0A192F]', 'text-white', 'shadow-sm'];
            const inactiveClasses = ['text-gray-500', 'hover:text-gray-700', 'bg-transparent'];

            if (tab === 'donatur') {
                // Merubah gaya tombol Donatur menjadi aktif
                tabDonatur.classList.add(...activeClasses);
                tabDonatur.classList.remove(...inactiveClasses);
                // Merubah gaya tombol Pengelola menjadi non-aktif
                tabPengelola.classList.add(...inactiveClasses);
                tabPengelola.classList.remove(...activeClasses);
                
                // Menampilkan form Donatur, menyembunyikan form Pengelola
                formDonatur.classList.remove('hidden');
                formDonatur.classList.add('flex');
                formPengelola.classList.add('hidden');
                formPengelola.classList.remove('flex');

                // Mengganti teks agar relevan
                title.innerText = 'Masuk ke DonasiKita';
                subtitle.innerText = 'Lanjutkan kebaikanmu dan bantu kampanye yang membutuhkan.';
            } 
            else if (tab === 'pengelola') {
                // Merubah gaya tombol Pengelola menjadi aktif
                tabPengelola.classList.add(...activeClasses);
                tabPengelola.classList.remove(...inactiveClasses);
                // Merubah gaya tombol Donatur menjadi non-aktif
                tabDonatur.classList.add(...inactiveClasses);
                tabDonatur.classList.remove(...activeClasses);
                
                // Menampilkan form Pengelola, menyembunyikan form Donatur
                formPengelola.classList.remove('hidden');
                formPengelola.classList.add('flex');
                formDonatur.classList.add('hidden');
                formDonatur.classList.remove('flex');

                // Mengganti teks agar relevan
                title.innerText = 'Portal Pengelola';
                subtitle.innerText = 'Masuk untuk mengelola kampanye, verifikasi data, dan pencairan dana.';
            }
        }
    </script>
</body>
</html>