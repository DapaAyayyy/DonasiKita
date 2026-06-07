<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - DonasiKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Mengimpor Inter dan Plus Jakarta Sans dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* Menjadikan Inter sebagai default font untuk seluruh halaman */
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-[#F8F9FA] lg:flex">

    <!-- Panel Kiri (Biru/Ungu Gradient) -->
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-[#1E2E81] via-[#2A3B9A] to-[#4339CA] p-16 flex-col justify-center text-white relative overflow-hidden">
        <!-- Teks Utama -->
        <div class="relative z-10">
            <!-- Menggunakan Logo Asli -->
            <div class="mb-8 flex items-center gap-3">
                <img src="{{ asset('assets/icons/donasikitaicon.png') }}" alt="Logo DonasiKita" class="h-20 w-auto drop-shadow-md">
            </div>

            <!-- Menambahkan Plus Jakarta Sans pada Slogan -->
            <h1 class="font-['Plus_Jakarta_Sans'] text-5xl lg:text-6xl font-extrabold leading-tight mb-6 drop-shadow-sm">
                Kebaikan Dimulai<br>Dari Sini
            </h1>
            <p class="text-lg text-blue-100 max-w-md leading-relaxed mb-12">
                Masuk dan lanjutkan kebaikanmu bersama kampanye sosial yang membutuhkan dukungan. Bersama kita bangun masa depan yang lebih peduli.
            </p>

            <!-- Fitur Bottom -->
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

    <!-- Panel Kanan (Card Form) -->
    <div class="w-full lg:w-1/2 min-h-screen flex flex-col relative px-4 py-6 sm:p-8">
        
        <!-- Tombol Kembali -->
        <a href="/" class="mb-6 inline-flex items-center gap-2 text-sm text-[#2A3B9A] font-semibold hover:underline lg:absolute lg:top-8 lg:left-8">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Beranda
        </a>

        <!-- Container Card Putih -->
        <div class="w-full max-w-[420px] mx-auto my-auto bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
            <!-- Menambahkan Plus Jakarta Sans pada Headline Kanan -->
            <h2 class="font-['Plus_Jakarta_Sans'] text-2xl sm:text-3xl font-extrabold text-[#0B132A] mb-2 tracking-tight">Masuk ke DonasiKita</h2>
            <p class="text-sm text-gray-500 mb-8 leading-relaxed">Lanjutkan kebaikanmu dan bantu kampanye yang membutuhkan.</p>

            @if (session('success'))
                <div class="mb-4 rounded-xl bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ url('/login') }}" method="POST" class="flex flex-col gap-4 sm:gap-5">
                @csrf
                <input type="hidden" name="login_as" id="login_as" value="{{ old('login_as', 'donatur') }}">

                <!-- Toggle Segment (Donatur / Pengelola) -->
                <div class="flex bg-gray-50 rounded-full p-1.5">
                    <button type="button" data-login-role="donatur" class="login-role-tab flex-1 py-2.5 rounded-full text-xs sm:text-sm transition-colors">
                        Donatur
                    </button>
                    <button type="button" data-login-role="pengelola" class="login-role-tab flex-1 py-2.5 rounded-full text-xs sm:text-sm transition-colors">
                        Pengelola
                    </button>
                </div>

                <!-- Input Email -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="nama@email.com" class="w-full px-4 sm:px-5 py-3.5 rounded-full border border-gray-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm placeholder-gray-400 transition-shadow">
                </div>

                <!-- Input Password -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-bold text-gray-700">Password</label>
                        <a href="#" class="text-xs text-[#4339CA] font-medium hover:underline">Lupa password?</a>
                    </div>
                    <div class="relative">
                        <input type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password" class="w-full px-4 sm:px-5 py-3.5 rounded-full border border-gray-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm placeholder-gray-400 transition-shadow">
                        <button type="button" class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                            <!-- Eye Icon -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="mt-4 w-full bg-[#5A4BFF] hover:bg-[#4a3ce0] text-white font-semibold py-3.5 sm:py-4 rounded-full flex justify-center items-center gap-2 transition-colors">
                    <span id="login-submit-label">Masuk sebagai Donatur</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-gray-500">
                Belum punya akun? <a href="{{ url('/register') }}" class="text-[#0B132A] font-semibold hover:underline">Daftar sebagai Donatur</a>
            </div>
        </div>
    </div>

    <script>
        const loginAsInput = document.getElementById('login_as');
        const loginSubmitLabel = document.getElementById('login-submit-label');
        const roleButtons = document.querySelectorAll('[data-login-role]');
        const activeClasses = ['bg-[#0A192F]', 'text-white', 'font-semibold', 'shadow-sm'];
        const inactiveClasses = ['text-gray-500', 'font-medium', 'hover:text-gray-700'];

        function setLoginRole(role) {
            const selectedRole = role === 'pengelola' ? 'pengelola' : 'donatur';
            loginAsInput.value = selectedRole;
            loginSubmitLabel.textContent = selectedRole === 'pengelola'
                ? 'Masuk sebagai Pengelola'
                : 'Masuk sebagai Donatur';

            roleButtons.forEach((button) => {
                const isActive = button.dataset.loginRole === selectedRole;
                button.classList.remove(...activeClasses, ...inactiveClasses);
                button.classList.add(...(isActive ? activeClasses : inactiveClasses));
            });
        }

        roleButtons.forEach((button) => {
            button.addEventListener('click', () => setLoginRole(button.dataset.loginRole));
        });

        setLoginRole(loginAsInput.value);
    </script>

</body>
</html>