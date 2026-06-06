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
<body class="min-h-screen bg-[#F8F9FA] lg:flex">

    <!-- Panel Kiri (Biru/Ungu Gradient dengan Efek Lingkaran) -->
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-[#2E3192] to-[#4B399A] p-10 xl:p-14 flex-col justify-center items-center text-center text-white relative overflow-hidden">
        
        <!-- Dekorasi Lingkaran -->
        <div class="absolute w-[350px] h-[350px] bg-white/5 rounded-full -top-20 -left-10"></div>
        <div class="absolute w-[250px] h-[250px] border border-white/10 rounded-full top-1/4 right-10"></div>
        <div class="absolute w-[450px] h-[450px] bg-white/5 rounded-full -bottom-24 right-5"></div>

        <!-- Konten Utama Kiri -->
        <div class="z-10 flex flex-col items-center">
            <img src="{{ asset('assets/icons/donasikitaicon.png') }}" alt="Logo DonasiKita" class="h-16 w-auto mb-6 drop-shadow-md">
            <h1 class="text-[21px] font-semibold mb-3 tracking-wide font-['Plus_Jakarta_Sans']">Kebaikan Dimulai Dari Sini</h1>
            <p class="text-[15px] text-blue-100 max-w-[380px] leading-relaxed">
                Masuk dan lanjutkan kebaikanmu bersama kampanye sosial yang membutuhkan dukungan. Jadilah bagian dari perubahan nyata hari ini.
            </p>
        </div>

        <!-- Teks Bottom -->
        <div class="absolute bottom-8 flex items-center gap-2 text-[14px] font-medium text-blue-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.965 11.965 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            Platform Donasi Terpercaya & Transparan
        </div>
    </div>

    <!-- Panel Kanan (Card Form) -->
    <div class="w-full lg:w-1/2 min-h-screen flex flex-col px-4 py-5 sm:p-6 lg:p-8 bg-[#F8F9FA]">
        
        <!-- Tombol Kembali -->
        <a href="/" class="mb-4 inline-flex w-fit items-center gap-2 text-sm text-[#4339CA] font-semibold hover:underline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Beranda
        </a>

        <!-- Container Card Putih -->
        <div class="w-full max-w-[500px] mx-auto mb-auto mt-0 lg:my-auto bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 lg:p-9 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100/50">
            
            <h2 class="text-[22px] sm:text-[24px] font-bold text-gray-800 mb-1.5 font-['Plus_Jakarta_Sans']">Daftar sebagai Donatur</h2>
            <p class="text-sm text-gray-500 mb-5 leading-relaxed">Buat akun untuk mulai berdonasi dan mengikuti kampanye sosial.</p>

            @if ($errors->any())
                <div class="mb-4 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ url('/register') }}" method="POST" class="grid grid-cols-2 gap-y-4 gap-x-4">
                @csrf
                
                <!-- Input Nama Lengkap (Full Width) -->
                <div class="col-span-2">
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required autocomplete="name" placeholder="John Doe" class="w-full px-4 py-3 bg-[#FCFCFD] border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-[#4339CA] focus:bg-white transition-colors">
                </div>

                <!-- Input Email (Half Width) -->
                <div class="col-span-2 sm:col-span-1">
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="john@example.com" class="w-full px-4 py-3 bg-[#FCFCFD] border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-[#4339CA] focus:bg-white transition-colors">
                </div>

                <!-- Input Nomor HP (Half Width) -->
                <div class="col-span-2 sm:col-span-1">
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Nomor HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" autocomplete="tel" placeholder="08123456789" class="w-full px-4 py-3 bg-[#FCFCFD] border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-[#4339CA] focus:bg-white transition-colors">
                </div>

                <!-- Input Alamat (Full Width) -->
                <div class="col-span-2">
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Alamat</label>
                    <input type="text" name="alamat" value="{{ old('alamat') }}" autocomplete="street-address" placeholder="Jl. Kebaikan No. 123, Jakarta" class="w-full px-4 py-3 bg-[#FCFCFD] border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-[#4339CA] focus:bg-white transition-colors">
                </div>

                <!-- Input Password (Half Width) -->
                <div class="col-span-2 sm:col-span-1">
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Password</label>
                    <input type="password" name="password" required autocomplete="new-password" placeholder="********" class="w-full px-4 py-3 bg-[#FCFCFD] border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-[#4339CA] focus:bg-white transition-colors">
                </div>

                <!-- Input Konfirmasi Password (Half Width) -->
                <div class="col-span-2 sm:col-span-1">
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="********" class="w-full px-4 py-3 bg-[#FCFCFD] border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-[#4339CA] focus:bg-white transition-colors">
                </div>

                <!-- Checkbox Syarat & Ketentuan -->
                <div class="col-span-2 flex items-start gap-3 mt-1">
                    <input type="checkbox" id="terms" name="terms" value="1" required class="mt-1 w-4 h-4 border-gray-300 rounded text-[#4339CA] focus:ring-[#4339CA]">
                    <label for="terms" class="text-[13px] text-gray-600 leading-relaxed">
                        Saya setuju dengan <a href="#" class="text-[#4339CA] font-medium hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="text-[#4339CA] font-medium hover:underline">Kebijakan Privasi</a> yang berlaku.
                    </label>
                </div>

                <!-- Tombol Submit -->
                <div class="col-span-2 mt-2">
                    <button type="submit" class="w-full bg-[#4339CA] hover:bg-[#3730A3] text-white font-semibold py-3 rounded-full flex justify-center items-center gap-2 transition-colors text-[15px]">
                        Daftar 
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    </button>
                </div>
            </form>

            <!-- Link ke Halaman Login -->
            <div class="mt-5 pt-4 border-t border-gray-100 text-center text-sm text-gray-500">
                Sudah punya akun? <a href="/login" class="text-[#4339CA] font-semibold hover:underline">Masuk</a>
            </div>
        </div>
    </div>

</body>
</html>
