<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Back-office Pengelola - DonasiKita')</title>
    <link rel="icon" href="{{ asset('assets/icons/donasikitaicon.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        body { font-family: Inter, sans-serif; }
        .font-display { font-family: 'Plus Jakarta Sans', sans-serif; }
        .material-symbols-outlined.fill { font-variation-settings: 'FILL' 1, 'wght' 500, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-[#F6F8FF] text-[#0B132A] min-h-screen">
@php
    $isAdminUtama = in_array(strtolower((string) session('auth_role')), ['super_admin', 'admin_utama'], true);
    $navItems = [
        ['route' => 'pengelola.dashboard', 'active' => ['pengelola.dashboard'], 'icon' => 'dashboard', 'label' => 'Dashboard'],
        ['route' => 'pengelola.donasi.index', 'active' => ['pengelola.donasi.*'], 'icon' => 'payments', 'label' => 'Donasi'],
        ['route' => 'pengelola.kampanye.index', 'active' => ['pengelola.kampanye.*'], 'icon' => 'campaign', 'label' => 'Kampanye'],
        ['route' => 'pengelola.penerima.index', 'active' => ['pengelola.penerima.*'], 'icon' => 'volunteer_activism', 'label' => 'Penerima'],
        ['route' => 'pengelola.laporan.index', 'active' => ['pengelola.laporan.*'], 'icon' => 'article', 'label' => 'Laporan'],
        ['route' => 'pengelola.donatur.index', 'active' => ['pengelola.donatur.*'], 'icon' => 'group', 'label' => 'Donatur'],
    ];

    if ($isAdminUtama) {
        $navItems[] = ['route' => 'pengelola.admin.index', 'active' => ['pengelola.admin.*'], 'icon' => 'admin_panel_settings', 'label' => 'Admin'];
    }
@endphp
<div class="min-h-screen lg:grid lg:grid-cols-[280px_1fr]">
    <aside class="bg-white border-r border-slate-200 lg:min-h-screen sticky top-0 z-30">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between lg:block">
            <a href="{{ route('pengelola.dashboard') }}" class="flex items-center gap-3">
                <img src="{{ asset('assets/icons/donasikitaicon.png') }}" alt="DonasiKita" class="h-10 w-10 object-contain">
                <div>
                    <p class="font-display font-extrabold text-lg text-[#3525cd]">DonasiKita</p>
                    <p class="text-xs text-slate-500">Back-office Pengelola</p>
                </div>
            </a>
        </div>
        <nav class="p-4 flex lg:flex-col gap-2 overflow-x-auto">
            @foreach($navItems as $item)
                @php $active = request()->routeIs(...$item['active']); @endphp
                <a href="{{ route($item['route']) }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl whitespace-nowrap transition {{ $active ? 'bg-[#3525cd] text-white shadow-lg shadow-indigo-200' : 'text-slate-600 hover:bg-slate-100 hover:text-[#3525cd]' }}">
                    <span class="material-symbols-outlined {{ $active ? 'fill' : '' }}">{{ $item['icon'] }}</span>
                    <span class="font-semibold text-sm">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>
    </aside>

    <div class="min-w-0">
        <header class="sticky top-0 z-20 bg-white/85 backdrop-blur border-b border-slate-200">
            <div class="px-4 md:px-8 py-4 flex flex-col md:flex-row md:items-center justify-between gap-3">
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400 font-bold">Pengelola Area</p>
                    <h1 class="font-display text-2xl font-extrabold">@yield('page_title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center gap-3">
                    <a href="/" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-100 text-slate-700 font-semibold text-sm hover:bg-slate-200">
                        <span class="material-symbols-outlined text-[18px]">home</span> Situs Publik
                    </a>
                    <div class="px-4 py-2 rounded-full bg-indigo-50 text-[#3525cd] font-semibold text-sm">
                        {{ session('auth_name') }}
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-600 text-white font-semibold text-sm hover:bg-red-700" type="submit">
                            <span class="material-symbols-outlined text-[18px]">logout</span> Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="px-4 md:px-8 py-8">
            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-green-100 bg-green-50 px-5 py-4 text-green-700 font-semibold flex items-center gap-3">
                    <span class="material-symbols-outlined">check_circle</span>{{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-100 bg-red-50 px-5 py-4 text-red-700">
                    <div class="font-bold flex items-center gap-2 mb-2"><span class="material-symbols-outlined">error</span> Ada yang perlu diperbaiki</div>
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
