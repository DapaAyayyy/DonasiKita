@php
    // Variabel auth dummy (nanti diganti dengan Auth::check() dari backend)
    $isLoggedIn = false; 
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Leaderboard - DonasiKita</title>
    <link rel="icon" href="{{ asset('assets/icons/donasikitaicon.png') }}" type="image/png">
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#3525cd", "surface-container-lowest": "#ffffff", "surface-container": "#e5eeff", "background": "#f8f9ff", "surface-variant": "#d3e4fe", "outline-variant": "#c7c4d8", "surface-container-low": "#eff4ff", "primary-fixed": "#e2dfff", "on-surface-variant": "#464555", "on-background": "#0b1c30"
                    },
                    "fontFamily": { "body-md": ["Inter"], "caption": ["Inter"], "label-md": ["Inter"], "display-lg": ["Plus Jakarta Sans"], "headline-md": ["Plus Jakarta Sans"], "headline-lg": ["Plus Jakarta Sans"], "body-lg": ["Inter"] },
                    "boxShadow": { 'soft-1': '0 4px 20px rgba(0, 0, 0, 0.05)', 'soft-2': '0 10px 30px rgba(0, 0, 0, 0.08)' }
                }
            }
        }
    </script>
    <style>
        .bg-hero-gradient { background: linear-gradient(135deg, #3525cd 0%, #831ada 100%); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .material-symbols-outlined.fill { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .podium-base {
            background: linear-gradient(180deg, #ffffff 0%, #e5eeff 100%);
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            box-shadow: inset 0 2px 5px rgba(255,255,255,1), 0 4px 6px rgba(0,0,0,0.05);
        }
        .rank-card { position: relative; z-index: 10; transform: translateY(12px); }
        .list-item-hover:hover { transform: translateX(4px); border-color: #3525cd; box-shadow: 0 4px 15px rgba(53, 37, 205, 0.1); }
    </style>
</head>
<body class="bg-background text-on-background font-body-md antialiased overflow-x-hidden">
    
    <!-- NAVBAR (Sama seperti sebelumnya) -->
    <nav class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-md border-b border-outline-variant/20 shadow-sm transition-all duration-300 ease-in-out">
        <div class="flex justify-between items-center px-6 md:px-12 py-4 max-w-[1280px] mx-auto">
            <a href="/" class="flex items-center cursor-pointer group">
                <img alt="DonasiKita Logo" class="h-[48px] py-1 w-auto object-contain group-hover:scale-105 transition-transform" src="{{ asset('assets/icons/donasikitaicon.png') }}">
            </a>            
            
            <div class="hidden md:flex items-center gap-12">
                <a class="flex items-center gap-2 text-on-surface-variant hover:text-primary border-b-[3px] border-transparent transition-colors pb-1" href="/">
                    <span class="material-symbols-outlined">home</span> <span class="font-bold text-sm">Beranda</span>
                </a>
                <a class="flex items-center gap-2 text-on-surface-variant hover:text-primary border-b-[3px] border-transparent transition-colors pb-1" href="/kampanye">
                    <span class="material-symbols-outlined">campaign</span> <span class="font-bold text-sm">Kampanye</span>
                </a>
                <a class="flex items-center gap-2 text-primary font-bold border-b-[3px] border-[#84cc16] transition-colors pb-1" href="/leaderboard">
                    <span class="material-symbols-outlined fill">emoji_events</span> <span class="font-bold text-sm">Leaderboard</span>
                </a>
            </div>

            <div class="flex items-center gap-4">
                @if($isLoggedIn)
                    <div class="flex items-center gap-2">
                        <img src="https://i.pravatar.cc/150?u=fajar" alt="Profile" class="w-10 h-10 rounded-full border-2 border-primary object-cover">
                        <a href="#" class="hidden md:flex px-2 py-2 text-on-surface-variant hover:text-red-500 font-bold text-sm transition-colors">Keluar</a>
                    </div>
                @else
                    <a href="/login" class="hidden md:flex px-4 py-2 text-primary font-bold text-sm hover:bg-surface-container-low rounded-full transition-colors">Login</a>
                    <a href="/register" class="flex items-center gap-2 px-6 py-2.5 text-white font-bold text-sm rounded-full shadow-soft-1 hover:shadow-soft-2 hover:opacity-90 transition-all bg-primary">
                        <span class="material-symbols-outlined text-[20px]">person_add</span>Daftar
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <!-- KONTEN LEADERBOARD -->
    <main class="pt-[80px]">
        <!-- Header Gradient Area -->
        <div class="bg-hero-gradient pt-16 pb-[140px] rounded-b-[40px] md:rounded-b-[80px] relative">
            <div class="text-center px-6 relative z-10">
                <div class="inline-block bg-white/20 text-white backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold mb-4 border border-white/20 shadow-sm">
                    Apresiasi Kebaikan
                </div>
                <h1 class="font-display-lg text-4xl md:text-5xl font-black text-white tracking-tight mb-4 drop-shadow-md">
                    Leaderboard Donatur
                </h1>
            </div>
        </div>

        <div class="max-w-[1280px] mx-auto px-4 -mt-[80px] relative z-20">

            @if(isset($leaderboard) && count($leaderboard) > 0)
                
                <!-- PODIUM SECTION (Hanya Top 3 dari Data Backend) -->
                <div class="flex flex-nowrap justify-center items-end gap-3 md:gap-6 mt-8 w-full">
                    
                    <!-- Peringkat 2 -->
                    @if(isset($leaderboard[1]))
                    <div class="flex flex-col items-center w-[130px] md:w-[180px]">
                        <div class="bg-surface-container-lowest p-4 rounded-2xl shadow-soft-1 flex flex-col items-center w-full rank-card border border-outline-variant/20">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($leaderboard[1]->nama) }}&background=e5eeff&color=3525cd&bold=true" alt="Juara 2" class="w-[60px] h-[60px] md:w-[76px] md:h-[76px] rounded-full object-cover mb-2 shadow-sm border-2 border-surface-container">
                            <div class="font-headline-lg text-xl md:text-2xl text-on-background">#2</div>
                            <div class="font-label-md text-[13px] md:text-[15px] text-on-surface-variant text-center mt-1 w-full truncate px-1" title="{{ $leaderboard[1]->nama }}">{{ $leaderboard[1]->nama }}</div>
                            <div class="font-headline-md text-sm md:text-base text-primary mt-2">Rp{{ number_format($leaderboard[1]->total_donasi, 0, ',', '.') }}</div>
                        </div>
                        <div class="w-[85%] h-[100px] md:h-[150px] podium-base border-x border-t border-outline-variant/30"></div>
                    </div>
                    @endif

                    <!-- Peringkat 1 (Tengah) -->
                    @if(isset($leaderboard[0]))
                    <div class="flex flex-col items-center w-[150px] md:w-[220px]">
                        <div class="bg-surface-container-lowest p-5 rounded-[24px] shadow-soft-2 flex flex-col items-center w-full rank-card border-b-[5px] border-primary">
                            <div class="absolute -right-2 top-[70px] md:top-[85px] bg-[#FACC15] p-1.5 md:p-2 rounded-full shadow-lg border-2 border-surface-container-lowest text-white">
                                <span class="material-symbols-outlined fill text-[20px]">star</span>
                            </div>
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($leaderboard[0]->nama) }}&background=3525cd&color=ffffff&bold=true" alt="Juara 1" class="w-[72px] h-[72px] md:w-[96px] md:h-[96px] rounded-full object-cover mb-3 shadow-md border-[4px] border-[#FACC15]">
                            <div class="font-display-lg text-3xl md:text-4xl text-on-background">#1</div>
                            <div class="font-label-md text-sm md:text-[17px] font-bold text-on-background text-center mt-1 w-full truncate" title="{{ $leaderboard[0]->nama }}">{{ $leaderboard[0]->nama }}</div>
                            <div class="font-headline-md text-base md:text-lg text-primary mt-2 bg-primary/10 px-3 py-1 rounded-full">Rp{{ number_format($leaderboard[0]->total_donasi, 0, ',', '.') }}</div>
                        </div>
                        <div class="w-[85%] h-[150px] md:h-[220px] podium-base border-x border-t border-primary/20 bg-gradient-to-b from-surface-container to-surface-variant"></div>
                    </div>
                    @endif

                    <!-- Peringkat 3 -->
                    @if(isset($leaderboard[2]))
                    <div class="flex flex-col items-center w-[130px] md:w-[180px]">
                        <div class="bg-surface-container-lowest p-4 rounded-2xl shadow-soft-1 flex flex-col items-center w-full rank-card border border-outline-variant/20">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($leaderboard[2]->nama) }}&background=e5eeff&color=3525cd&bold=true" alt="Juara 3" class="w-[60px] h-[60px] md:w-[76px] md:h-[76px] rounded-full object-cover mb-2 shadow-sm border-2 border-surface-container">
                            <div class="font-headline-lg text-xl md:text-2xl text-on-background">#3</div>
                            <div class="font-label-md text-[13px] md:text-[15px] text-on-surface-variant text-center mt-1 w-full truncate px-1" title="{{ $leaderboard[2]->nama }}">{{ $leaderboard[2]->nama }}</div>
                            <div class="font-headline-md text-sm md:text-base text-primary mt-2">Rp{{ number_format($leaderboard[2]->total_donasi, 0, ',', '.') }}</div>
                        </div>
                        <div class="w-[85%] h-[80px] md:h-[120px] podium-base border-x border-t border-outline-variant/30"></div>
                    </div>
                    @endif

                </div>

                <!-- LIST SECTION (Peringkat 4 dan seterusnya) -->
                @if(count($leaderboard) > 3)
                <div class="max-w-3xl mx-auto mt-16 px-2">
                    <h3 class="font-headline-md text-xl text-on-background mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">format_list_numbered</span>
                        Peringkat Lainnya
                    </h3>
                    
                    <div class="flex flex-col gap-3">
                        @foreach($leaderboard as $index => $juara)
                            @if($index >= 3)
                            <div class="list-item-hover flex items-center justify-between p-4 bg-surface-container-lowest rounded-2xl shadow-soft-1 border border-outline-variant/20 transition-all duration-300">
                                <div class="flex items-center gap-4 md:gap-6">
                                    <div class="font-headline-md text-xl text-on-surface-variant w-8 text-center">#{{ $index + 1 }}</div>
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($juara->nama) }}&background=f8f9ff&color=464555" alt="{{ $juara->nama }}" class="w-12 h-12 rounded-full object-cover shadow-sm border border-outline-variant/30">
                                    <div class="font-label-md text-base md:text-lg text-on-background">{{ $juara->nama }}</div>
                                </div>
                                <div class="font-headline-md text-base md:text-lg text-primary bg-surface-container px-4 py-1.5 rounded-full">
                                    Rp{{ number_format($juara->total_donasi, 0, ',', '.') }}
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

            @else
                <!-- Tampilan jika data kosong dari Backend -->
                <div class="max-w-2xl mx-auto mt-12 bg-white p-12 rounded-3xl shadow-soft-1 text-center border border-outline-variant/30">
                    <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">volunteer_activism</span>
                    <h2 class="font-headline-md text-2xl text-on-background mb-2">Belum Ada Donatur</h2>
                    <p class="text-on-surface-variant font-body-md">Jadilah pahlawan pertama yang menginspirasi kebaikan hari ini. Berikan donasimu sekarang!</p>
                </div>
            @endif

            <!-- Bottom Call to Action -->
            <div class="mt-20 text-center">
                <h2 class="font-headline-lg text-2xl md:text-3xl text-on-background mb-2">Terima Kasih Orang Baik</h2>
                <p class="font-body-md text-on-surface-variant text-sm md:text-base">Kebaikanmu telah membantu menciptakan senyum baru hari ini.</p>
            </div>
            
            <div class="w-full max-w-4xl mx-auto h-px bg-outline-variant/40 mt-16 mb-8"></div>
        </div>
    </main>
</body>
</html>