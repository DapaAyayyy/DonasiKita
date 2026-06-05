<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Donatur - DonasiKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Mengimpor Inter dan Plus Jakarta Sans dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* Menjadikan Inter sebagai default font */
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="flex min-h-screen bg-[#F8F9FA]">

    <!-- Panel Kiri (Biru/Ungu Gradient dengan Efek Lingkaran) -->
    <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-[#2E3192] to-[#4B399A] p-16 flex-col justify-center items-center text-center text-white relative overflow-hidden">
        
        <!-- Dekorasi Lingkaran -->
        <div class="absolute w-[350px] h-[350px] bg-white/5 rounded-full -top-20 -left-10"></div>
        <div class="absolute w-[250px] h-[250px] border border-white/10 rounded-full top-1/4 right-10"></div>
        <div class="absolute w-[450px] h-[450px] bg-white/5 rounded-full -bottom-24 right-5"></div>

        <!-- Konten Utama Kiri -->
        <div class="z-10 flex flex-col items-center">
            <img src="{{ asset('assets/icons/donasikitaicon.png') }}" alt="Logo DonasiKita" class="h-20 w-auto mb-8 drop-shadow-md">
            <h1 class="text-[22px] font-semibold mb-4 tracking-wide font-['Plus_Jakarta_Sans']">Kebaikan Dimulai Dari Sini</h1>
            <p class="text-[16px] text-blue-100 max-w-[380px] leading-relaxed">
                Masuk dan lanjutkan kebaikanmu bersama kampanye sosial yang membutuhkan dukungan. Jadilah bagian dari perubahan nyata hari ini.
            </p>
        </div>

        <!-- Teks Bottom -->
        <div class="absolute bottom-10 flex items-center gap-2 text-[15px] font-medium text-blue-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.965 11.965 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            Platform Donasi Terpercaya & Transparan
        </div>
    </div>

    <!-- Panel Kanan (Card Form) -->
    <div class="w-full lg:w-1/2 flex flex-col relative p-8 bg-[#F8F9FA]">
        
        <!-- Tombol Kembali -->
        <a href="/" class="absolute top-8 left-8 flex items-center gap-2 text-[15px] text-[#4339CA] font-semibold hover:underline">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Beranda
        </a>

        <!-- Container Card Putih -->
        <div class="m-auto w-full max-w-[540px] bg-white rounded-3xl p-10 md:p-12 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100/50">
            
            <h2 class="text-[24px] font-bold text-gray-800 mb-2 font-['Plus_Jakarta_Sans']">Daftar sebagai Donatur</h2>
            <p class="text-[15px] text-gray-500 mb-8 leading-relaxed">Buat akun untuk mulai berdonasi dan mengikuti kampanye sosial.</p>

            <!-- Form -->
            <form action="/register" method="POST" class="grid grid-cols-2 gap-y-6 gap-x-5">
                @csrf
                
                <!-- Input Nama Lengkap (Full Width) -->
                <div class="col-span-2">
                    <label class="block text-[14px] font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" placeholder="John Doe" class="w-full px-5 py-3.5 bg-[#FCFCFD] border border-gray-200 rounded-lg text-[15px] focus:outline-none focus:border-[#4339CA] focus:bg-white transition-colors">
                </div>

                <!-- Input Email (Half Width) -->
                <div class="col-span-1">
                    <label class="block text-[14px] font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" placeholder="john@example.com" class="w-full px-5 py-3.5 bg-[#FCFCFD] border border-gray-200 rounded-lg text-[15px] focus:outline-none focus:border-[#4339CA] focus:bg-white transition-colors">
                </div>

                <!-- Input Nomor HP (Half Width) -->
                <div class="col-span-1">
                    <label class="block text-[14px] font-semibold text-gray-700 mb-2">Nomor HP</label>
                    <input type="text" placeholder="08123456789" class="w-full px-5 py-3.5 bg-[#FCFCFD] border border-gray-200 rounded-lg text-[15px] focus:outline-none focus:border-[#4339CA] focus:bg-white transition-colors">
                </div>

                <!-- Input Alamat (Full Width) -->
                <div class="col-span-2">
                    <label class="block text-[14px] font-semibold text-gray-700 mb-2">Alamat</label>
                    <input type="text" placeholder="Jl. Kebaikan No. 123, Jakarta" class="w-full px-5 py-3.5 bg-[#FCFCFD] border border-gray-200 rounded-lg text-[15px] focus:outline-none focus:border-[#4339CA] focus:bg-white transition-colors">
                </div>

                <!-- Input Password (Half Width) -->
                <div class="col-span-1">
                    <label class="block text-[14px] font-semibold text-gray-700 mb-2">Password</label>
                    <input type="password" placeholder="••••••••" class="w-full px-5 py-3.5 bg-[#FCFCFD] border border-gray-200 rounded-lg text-[15px] focus:outline-none focus:border-[#4339CA] focus:bg-white transition-colors">
                </div>

                <!-- Input Konfirmasi Password (Half Width) -->
                <div class="col-span-1">
                    <label class="block text-[14px] font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                    <input type="password" placeholder="••••••••" class="w-full px-5 py-3.5 bg-[#FCFCFD] border border-gray-200 rounded-lg text-[15px] focus:outline-none focus:border-[#4339CA] focus:bg-white transition-colors">
                </div>

                <!-- Checkbox Syarat & Ketentuan -->
                <div class="col-span-2 flex items-start gap-3 mt-2">
                    <input type="checkbox" id="terms" class="mt-1 w-4 h-4 border-gray-300 rounded text-[#4339CA] focus:ring-[#4339CA]">
                    <label for="terms" class="text-[14px] text-gray-600 leading-relaxed">
                        Saya setuju dengan <a href="#" class="text-[#4339CA] font-medium hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="text-[#4339CA] font-medium hover:underline">Kebijakan Privasi</a> yang berlaku.
                    </label>
                </div>

                <!-- Tombol Submit -->
                <div class="col-span-2 mt-4">
                    <button type="submit" class="w-full bg-[#4339CA] hover:bg-[#3730A3] text-white font-semibold py-3.5 rounded-full flex justify-center items-center gap-2 transition-colors text-[16px]">
                        Daftar 
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    </button>
                </div>
            </form>

            <!-- Link ke Halaman Login -->
            <div class="mt-8 pt-6 border-t border-gray-100 text-center text-[15px] text-gray-500">
                Sudah punya akun? <a href="/login" class="text-[#4339CA] font-semibold hover:underline">Masuk</a>
            </div>
        </div>
    </div>

</body>
</html>