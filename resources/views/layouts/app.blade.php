<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DonasiKita</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* CSS Khusus untuk efek teks garis tepi hitam dari desain UI-mu */
        .teks-garis-hitam {
            color: white;
            -webkit-text-stroke: 1px black;
        }
        .teks-garis-hitam-tebal {
            color: white;
            -webkit-text-stroke: 1.5px black;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800">

    <!-- NAVBAR -->
    <nav class="bg-slate-50 py-4 px-6 border-b border-gray-200">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            
            <!-- Logo (Sesuai kotak desain UI) -->
            <div class="flex items-center">
                <div class="bg-green-600 text-white font-bold px-2 py-0.5 border border-black text-xs flex items-center gap-1">
                    <span class="text-red-500 bg-blue-800 px-1 text-[10px]">D</span> 
                    <span class="text-red-500">DonasiKita</span>
                </div>
            </div>
            
            <!-- Menu Sesuai Desain UI -->
            <div class="flex items-center gap-6 text-sm text-black">
                <a href="/" class="border-b border-black pb-0.5">Beranda</a>
                <a href="#" class="hover:text-gray-600">Leaderboard</a>
                <a href="#" class="border border-black px-4 py-1 bg-white hover:bg-gray-100">Login</a>
            </div>
        </div>
    </nav>

    <!-- AREA KONTEN -->
    <main class="max-w-6xl mx-auto px-6 py-8 min-h-screen">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-slate-50 py-8 flex flex-col md:flex-row justify-between text-[10px] text-black max-w-6xl mx-auto px-6">
        <p>&copy; 2026 DonasiKita</p>
        <p>Dibuat dengan semangat untuk Projek Akhir RPL</p>
    </footer>

</body>
</html>