<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <title>@yield('title', 'DonasiKita - Kebaikan Dimulai Dari Sini')</title>
    <link rel="icon" href="{{ asset('assets/icons/donasikitaicon.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "secondary-container": "#9e41f5", "surface-container-lowest": "#ffffff", "primary": "#3525cd", "surface-container-highest": "#d3e4fe", "primary-fixed-dim": "#c3c0ff", "tertiary-container": "#006a7c", "surface-dim": "#cbdbf5", "outline-variant": "#c7c4d8", "surface": "#f8f9ff", "on-secondary-fixed": "#2c0051", "tertiary-fixed-dim": "#4cd7f6", "primary-container": "#4f46e5", "on-primary-fixed": "#0f0069", "surface-container": "#e5eeff", "background": "#f8f9ff", "on-error": "#ffffff", "on-tertiary": "#ffffff", "secondary": "#831ada", "secondary-fixed-dim": "#ddb8ff", "on-error-container": "#93000a", "surface-variant": "#d3e4fe", "tertiary": "#00505f", "inverse-primary": "#c3c0ff", "error-container": "#ffdad6", "on-tertiary-fixed": "#001f26", "surface-container-low": "#eff4ff", "primary-fixed": "#e2dfff", "on-surface-variant": "#464555", "on-tertiary-container": "#93e8ff", "on-secondary-fixed-variant": "#6800b4", "error": "#ba1a1a", "tertiary-fixed": "#acedff", "outline": "#777587", "secondary-fixed": "#f0dbff", "on-primary-container": "#dad7ff", "inverse-surface": "#213145", "surface-tint": "#4d44e3", "surface-container-high": "#dce9ff", "on-tertiary-fixed-variant": "#004e5c", "surface-bright": "#f8f9ff", "on-surface": "#0b1c30", "on-secondary-container": "#fffbff", "on-background": "#0b1c30", "on-primary": "#ffffff", "on-secondary": "#ffffff", "inverse-on-surface": "#eaf1ff", "on-primary-fixed-variant": "#3323cc"
                    },
                    "borderRadius": { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1.5rem", "full": "9999px" },
                    "spacing": { "lg": "48px", "gutter": "24px", "base": "8px", "md": "24px", "xs": "4px", "container-max": "1280px", "sm": "12px", "xl": "80px" },
                    "fontFamily": { "body-md": ["Inter"], "caption": ["Inter"], "headline-lg-mobile": ["Plus Jakarta Sans"], "label-md": ["Inter"], "display-lg": ["Plus Jakarta Sans"], "headline-md": ["Plus Jakarta Sans"], "headline-lg": ["Plus Jakarta Sans"], "body-lg": ["Inter"] },
                    "fontSize": { "body-md": ["16px", { "lineHeight": "1.6", "fontWeight": "400" }], "caption": ["12px", { "lineHeight": "1.4", "fontWeight": "400" }], "headline-lg-mobile": ["28px", { "lineHeight": "1.3", "fontWeight": "700" }], "label-md": ["14px", { "lineHeight": "1.4", "fontWeight": "600" }], "display-lg": ["48px", { "lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "800" }], "headline-md": ["24px", { "lineHeight": "1.4", "fontWeight": "700" }], "headline-lg": ["32px", { "lineHeight": "1.3", "fontWeight": "700" }], "body-lg": ["18px", { "lineHeight": "1.6", "fontWeight": "400" }] },
                    "boxShadow": { 'soft-1': '0 4px 20px rgba(0, 0, 0, 0.05)', 'soft-2': '0 10px 30px rgba(0, 0, 0, 0.08)' }
                }
            }
        }
    </script>
    <style>
        .gradient-text { background-clip: text; -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .bg-hero-gradient { background: linear-gradient(135deg, #3525cd 0%, #831ada 100%); }
        .bg-progress-gradient { background: linear-gradient(90deg, #4CD7F6 0%, #3525CD 100%); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .material-symbols-outlined.fill { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-background text-on-background font-body-md antialiased overflow-x-hidden">
    
    <nav class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-md shadow-sm transition-all duration-300 ease-in-out">
        <div class="grid grid-cols-[auto_1fr] md:grid-cols-[180px_1fr_180px] lg:grid-cols-[300px_1fr_300px] items-center px-lg py-md max-w-container-max mx-auto">
            <a href="/" class="flex items-center cursor-pointer group justify-self-start">
                <img alt="DonasiKita Logo" class="h-[48px] py-1 w-auto object-contain group-hover:scale-105 transition-transform" 
                    src="{{ asset('assets/icons/donasikitaicon.png') }}">
            </a>            
            
            <div class="hidden md:flex items-center justify-center gap-sm lg:gap-md">
                <a class="flex items-center gap-xs {{ request()->is('/') ? 'text-primary font-bold border-b-2 border-[#84cc16]' : 'text-on-surface-variant hover:text-primary' }} transition-colors pb-1" href="/">
                    <span class="material-symbols-outlined fill">home</span>
                    <span class="font-label-md text-label-md">Beranda</span>
                </a>

                <a class="flex items-center gap-xs {{ request()->is('kampanye') || request()->is('kampanye/*') ? 'text-primary font-bold border-b-2 border-[#84cc16]' : 'text-on-surface-variant hover:text-primary' }} transition-colors pb-1" href="/kampanye">
                    <span class="material-symbols-outlined">campaign</span>
                    <span class="font-label-md text-label-md">Kampanye</span>
                </a>

                <a class="flex items-center gap-xs {{ request()->is('leaderboard') ? 'text-primary font-bold border-b-2 border-[#84cc16]' : 'text-on-surface-variant hover:text-primary' }} transition-colors pb-1" href="{{ route('leaderboard.index') }}">
                    <span class="material-symbols-outlined">emoji_events</span>
                    <span class="font-label-md text-label-md">Leaderboard</span>
                </a>

                {{-- Tambahan menu Riwayat yang hanya muncul kalau udah login sebagai donatur --}}
                @if(session('auth_type') === 'donatur')
                    <a class="flex items-center gap-xs {{ request()->is('riwayat-donasi') ? 'text-primary font-bold border-b-2 border-[#84cc16]' : 'text-on-surface-variant hover:text-primary' }} transition-colors pb-1" href="{{ route('donatur.riwayat') }}">
                        <span class="material-symbols-outlined">history</span>
                        <span class="font-label-md text-label-md">Riwayat</span>
                    </a>
                @endif
            </div>

            <div class="hidden md:flex items-center justify-end gap-sm justify-self-end">
                @if(session('auth_type'))
                    <div class="hidden lg:flex items-center gap-xs px-md py-sm bg-surface-container-high text-[#336600] font-label-md text-label-md rounded-full">
                        <span class="material-symbols-outlined fill text-[18px]">account_circle</span>
                        {{ session('auth_name') }}
                    </div>

                    {{-- Tombol logout dipisah dari menu utama supaya navbar tetap benar-benar di tengah --}}
                    <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                        @csrf
                        <button type="submit" class="flex items-center gap-xs px-md py-sm text-white font-bold text-sm rounded-full shadow-soft-1 hover:shadow-soft-2 hover:opacity-90 transition-all active:scale-95 bg-[#c81e1e]">
                            <span class="material-symbols-outlined text-[18px]">logout</span>
                            Logout
                        </button>
                    </form>
                @else
                    <a href="/login" class="flex items-center gap-xs px-sm py-sm text-primary font-label-md text-label-md hover:bg-surface-container-high/50 rounded-full transition-colors">Login</a>
                    <a href="/register" class="flex items-center gap-xs px-md py-sm text-white font-label-md text-label-md rounded-full shadow-soft-1 hover:shadow-soft-2 hover:opacity-90 transition-all active:scale-95 bg-primary"><span class="material-symbols-outlined">person_add</span>Daftar</a>
                @endif
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="w-full mt-lg bg-surface-container-low dark:bg-inverse-surface border-t border-outline-variant/20">
        <div class="flex flex-col md:flex-row justify-between items-center px-lg py-xl max-w-container-max mx-auto gap-md">
            <div class="flex flex-col items-center md:items-start gap-xs">
                <a href="/" class="flex items-center cursor-pointer group">
                    <img alt="DonasiKita Logo" class="h-[48px] py-1 w-auto object-contain group-hover:scale-105 transition-transform" 
                        src="{{ asset('assets/icons/donasikitaicon.png') }}">
                </a>
                <p class="font-caption text-caption text-on-surface-variant dark:text-on-surface-variant text-center md:text-left mt-sm">
                    © 2026 DonasiKita. Kebaikan Dimulai Dari Sini.
                </p>
                <p class="font-caption text-caption text-on-surface-variant/70 text-center md:text-left">
                    Dibuat dengan semangat untuk Projek Akhir RPL (｡・ω・｡)
                </p>
            </div>
            
            <!-- Perbaikan: Menghapus tombol login/daftar yang tersasar di footer -->
            <div class="flex flex-wrap justify-center gap-md md:gap-lg font-body-md text-body-md">
                <a class="text-on-surface-variant dark:text-on-surface-variant hover:text-primary dark:hover:text-primary-fixed transition-colors" href="/tentang-kami">Tentang Kami</a>
                <a class="text-on-surface-variant dark:text-on-surface-variant hover:text-primary dark:hover:text-primary-fixed transition-colors" href="/hubungi-kami">Hubungi Kami</a>
                <a class="text-on-surface-variant dark:text-on-surface-variant hover:text-primary dark:hover:text-primary-fixed transition-colors" href="#">Kebijakan Privasi</a>
                <a class="text-on-surface-variant dark:text-on-surface-variant hover:text-primary dark:hover:text-primary-fixed transition-colors" href="#">Syarat & Ketentuan</a>
            </div>
        </div>
    </footer>
</body>
</html>