@php
    $isLoggedIn = false; // Ubah ke true untuk melihat versi sudah login (Avatar)
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <title>Leaderboard - DonasiKita</title>
    <link rel="icon" href="{{ asset('assets/icons/donasikitaicon.png') }}" type="image/png">
    
    <!-- Anggap menggunakan Vite, hapus jika kamu hanya pakai CDN -->
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->

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
        
        /* Efek pedestal/silinder podium yang disesuaikan dengan tema surface */
        .podium-base {
            background: linear-gradient(180deg, #ffffff 0%, #e5eeff 100%);
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            box-shadow: inset 0 2px 5px rgba(255,255,255,1), 0 4px 6px rgba(0,0,0,0.05);
        }
        .rank-card {
            position: relative;
            z-index: 10;
            transform: translateY(12px);
        }
    </style>
</head>
<body class="bg-background text-on-background font-body-md antialiased overflow-x-hidden">
    
    <!-- NAVBAR UTAMA -->
    <nav class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-md border-b border-outline-variant/20 shadow-sm transition-all duration-300 ease-in-out">
        <div class="flex justify-between items-center px-lg py-md max-w-container-max mx-auto">
            <!-- Logo dengan link ke Beranda -->
            <a href="/" class="flex items-center cursor-pointer group">
                <img alt="DonasiKita Logo" class="h-[48px] py-1 w-auto object-contain group-hover:scale-105 transition-transform" 
                    src="{{ asset('assets/icons/donasikitaicon.png') }}">
            </a>            
            
            <!-- Menu Tengah -->
            <div class="hidden md:flex items-center gap-lg">
                <!-- Tab Beranda -->
                <a class="flex items-center gap-xs {{ request()->is('/') ? 'text-primary font-bold border-b-[3px] border-[#84cc16]' : 'text-on-surface-variant hover:text-primary border-b-[3px] border-transparent' }} transition-colors pb-1" href="/">
                    <span class="material-symbols-outlined {{ request()->is('/') ? 'fill' : '' }}">home</span>
                    <span class="font-label-md text-label-md">Beranda</span>
                </a>

                <!-- Tab Kampanye -->
                <a class="flex items-center gap-xs {{ request()->is('kampanye') || request()->is('kampanye/*') ? 'text-primary font-bold border-b-[3px] border-[#84cc16]' : 'text-on-surface-variant hover:text-primary border-b-[3px] border-transparent' }} transition-colors pb-1" href="/kampanye">
                    <span class="material-symbols-outlined {{ request()->is('kampanye') ? 'fill' : '' }}">campaign</span>
                    <span class="font-label-md text-label-md">Kampanye</span>
                </a>

                <!-- Tab Leaderboard (Akan otomatis Aktif jika routingnya /leaderboard) -->
                <a class="flex items-center gap-xs {{ request()->is('leaderboard') ? 'text-primary font-bold border-b-[3px] border-[#84cc16]' : 'text-on-surface-variant hover:text-primary border-b-[3px] border-transparent' }} transition-colors pb-1" href="/leaderboard">
                    <span class="material-symbols-outlined {{ request()->is('leaderboard') ? 'fill' : '' }}">emoji_events</span>
                    <span class="font-label-md text-label-md">Leaderboard</span>
                </a>
            </div>

            <!-- Menu Kanan (Auth Logic) -->
            <div class="flex items-center gap-sm">
                @if($isLoggedIn)
                    <div class="flex items-center gap-xs">
                        <img src="https://i.pravatar.cc/150?u=fajar" alt="Profile" class="w-10 h-10 rounded-full border-2 border-primary object-cover">
                        <a href="#" class="hidden md:flex px-sm py-sm text-on-surface-variant hover:text-error font-label-md text-label-md transition-colors">Keluar</a>
                    </div>
                @else
                    <a href="/login" class="hidden md:flex items-center gap-xs px-sm py-sm text-primary font-label-md text-label-md hover:bg-surface-container-high/50 rounded-full transition-colors">Login</a>
                    <a href="/register" class="flex items-center gap-xs px-md py-sm text-white font-label-md text-label-md rounded-full shadow-soft-1 hover:shadow-soft-2 hover:opacity-90 transition-all active:scale-95 bg-primary">
                        <span class="material-symbols-outlined">person_add</span>Daftar
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <!-- KONTEN LEADERBOARD -->
    <main class="pt-[80px]"> <!-- pt-[80px] untuk menghindari konten tertutup navbar fixed -->
        
        <!-- Header Gradient Area menggunakan theme config -->
        <div class="bg-hero-gradient pt-16 pb-[140px] rounded-b-[40px] md:rounded-b-[80px] relative">
            <div class="text-center px-6 relative z-10">
                <div class="inline-block bg-white/20 text-white backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold mb-4 border border-white/20 shadow-sm">
                    Apresiasi Kebaikan
                </div>
                <h1 class="font-display-lg text-4xl md:text-5xl font-black text-white tracking-tight mb-4 drop-shadow-md">
                    Leaderboard Donatur
                </h1>
                <p class="text-white/80 font-body-lg text-[15px] md:text-base max-w-xl mx-auto drop-shadow leading-relaxed">
                    Platform donasi terpercaya. Bersama kita menciptakan perubahan nyata. Inilah para pahlawan yang paling banyak berbagi kebaikan hari ini.
                </p>
            </div>
        </div>

        <div class="max-w-container-max mx-auto px-4 -mt-[80px] relative z-20">
            
            <!-- Top Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 max-w-5xl mx-auto">
                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-soft-1 border border-outline-variant/30 flex flex-col items-center md:items-start">
                    <div class="p-3 bg-surface-container rounded-xl text-primary mb-3">
                        <span class="material-symbols-outlined">campaign</span>
                    </div>
                    <div class="font-headline-lg text-3xl text-on-background">6</div>
                    <span class="font-label-md text-on-surface-variant mt-1">Kampanye Aktif</span>
                </div>

                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-soft-1 border border-outline-variant/30 flex flex-col items-center md:items-start">
                    <div class="p-3 bg-green-50 rounded-xl text-green-600 mb-3">
                        <span class="material-symbols-outlined">group</span>
                    </div>
                    <div class="font-headline-lg text-3xl text-on-background">145</div>
                    <span class="font-label-md text-on-surface-variant mt-1">Donatur Terdaftar</span>
                </div>

                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-soft-1 border border-outline-variant/30 flex flex-col items-center md:items-start">
                    <div class="p-3 bg-surface-container rounded-xl text-primary mb-3">
                        <span class="material-symbols-outlined">account_balance_wallet</span>
                    </div>
                    <div class="font-headline-md lg:font-headline-lg text-2xl lg:text-3xl text-on-background">Rp 130.342.323</div>
                    <span class="font-label-md text-on-surface-variant mt-1">Dana Terkumpul</span>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="flex justify-center mb-16">
                <div class="relative w-full max-w-lg">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-outline">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                    <input type="text" class="w-full pl-14 pr-6 py-4 rounded-full border border-outline-variant/50 shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-fixed focus:border-primary transition-shadow font-body-md bg-surface-container-lowest text-on-background" placeholder="Cari Donatur yang ingin Anda temukan...">
                </div>
            </div>

            <!-- Podium Section (5 Ranks Sejajar) -->
            <div class="flex flex-nowrap justify-center items-end gap-2 md:gap-4 mt-8 overflow-x-auto pb-10 w-full snap-x">
                
                <!-- Rank 4 -->
                <div class="flex flex-col items-center min-w-[100px] md:min-w-[140px] snap-center">
                    <div class="bg-surface-container-lowest p-3 rounded-2xl shadow-soft-1 flex flex-col items-center w-full rank-card border border-outline-variant/20">
                        <img src="https://i.pravatar.cc/150?img=8" alt="Agus" class="w-[50px] h-[50px] md:w-[64px] md:h-[64px] rounded-full object-cover mb-2 shadow-sm">
                        <div class="font-headline-md text-lg text-on-background">#4</div>
                        <div class="font-label-md text-[11px] md:text-[13px] text-on-surface-variant text-center mt-1 w-full truncate px-1">Agus S.</div>
                    </div>
                    <div class="w-[85%] h-[60px] md:h-[90px] podium-base border-x border-t border-outline-variant/30"></div>
                </div>

                <!-- Rank 2 -->
                <div class="flex flex-col items-center min-w-[110px] md:min-w-[160px] snap-center">
                    <div class="bg-surface-container-lowest p-4 rounded-2xl shadow-soft-1 flex flex-col items-center w-full rank-card border border-outline-variant/20">
                        <img src="https://i.pravatar.cc/150?img=11" alt="Budi" class="w-[60px] h-[60px] md:w-[76px] md:h-[76px] rounded-full object-cover mb-2 shadow-sm">
                        <div class="font-headline-lg text-xl md:text-2xl text-on-background">#2</div>
                        <div class="font-label-md text-xs md:text-sm text-on-surface-variant text-center mt-1 w-full truncate px-1">Budi Santoso</div>
                    </div>
                    <div class="w-[85%] h-[100px] md:h-[150px] podium-base border-x border-t border-outline-variant/30"></div>
                </div>

                <!-- Rank 1 (The Winner) -->
                <div class="flex flex-col items-center min-w-[130px] md:min-w-[190px] snap-center">
                    <div class="bg-surface-container-lowest p-5 rounded-[24px] shadow-soft-2 flex flex-col items-center w-full rank-card border-b-[5px] border-primary">
                        <!-- Gold Badge -->
                        <div class="absolute -right-2 top-[70px] md:top-[85px] bg-[#FACC15] p-1.5 md:p-2 rounded-full shadow-lg border-2 border-surface-container-lowest text-white">
                            <span class="material-symbols-outlined fill text-[20px]">star</span>
                        </div>
                        <img src="https://i.pravatar.cc/150?u=fajar" alt="Fajar" class="w-[72px] h-[72px] md:w-[96px] md:h-[96px] rounded-full object-cover mb-3 shadow-md border-[3px] border-surface-container">
                        <div class="font-display-lg text-3xl md:text-4xl text-on-background">#1</div>
                        <div class="font-label-md text-sm md:text-base text-on-background text-center mt-1">Fajar Nugraha</div>
                    </div>
                    <div class="w-[85%] h-[150px] md:h-[220px] podium-base border-x border-t border-primary/20 bg-gradient-to-b from-surface-container to-surface-variant"></div>
                </div>

                <!-- Rank 3 -->
                <div class="flex flex-col items-center min-w-[110px] md:min-w-[160px] snap-center">
                    <div class="bg-surface-container-lowest p-4 rounded-2xl shadow-soft-1 flex flex-col items-center w-full rank-card border border-outline-variant/20">
                        <img src="https://i.pravatar.cc/150?img=5" alt="Siti" class="w-[60px] h-[60px] md:w-[76px] md:h-[76px] rounded-full object-cover mb-2 shadow-sm">
                        <div class="font-headline-lg text-xl md:text-2xl text-on-background">#3</div>
                        <div class="font-label-md text-xs md:text-sm text-on-surface-variant text-center mt-1 w-full truncate px-1">Siti Aminah</div>
                    </div>
                    <div class="w-[85%] h-[80px] md:h-[120px] podium-base border-x border-t border-outline-variant/30"></div>
                </div>

                <!-- Rank 5 -->
                <div class="flex flex-col items-center min-w-[100px] md:min-w-[140px] snap-center">
                    <div class="bg-surface-container-lowest p-3 rounded-2xl shadow-soft-1 flex flex-col items-center w-full rank-card border border-outline-variant/20">
                        <img src="https://i.pravatar.cc/150?img=9" alt="Dewi" class="w-[50px] h-[50px] md:w-[64px] md:h-[64px] rounded-full object-cover mb-2 shadow-sm">
                        <div class="font-headline-md text-lg text-on-background">#5</div>
                        <div class="font-label-md text-[11px] md:text-[13px] text-on-surface-variant text-center mt-1 w-full truncate px-1">Dewi S.</div>
                    </div>
                    <div class="w-[85%] h-[40px] md:h-[60px] podium-base border-x border-t border-outline-variant/30"></div>
                </div>

            </div>

            <!-- Bottom Call to Action -->
            <div class="mt-16 text-center">
                <h2 class="font-headline-lg text-2xl md:text-3xl text-on-background mb-2">Terima Kasih Orang Baik</h2>
                <p class="font-body-md text-on-surface-variant text-sm md:text-base">Kebaikanmu telah membantu menciptakan senyum baru hari ini.</p>
            </div>
            
            <div class="w-full max-w-4xl mx-auto h-px bg-outline-variant/40 mt-16 mb-8"></div>
        </div>
    </main>

    <!-- FOOTER UTAMA -->
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