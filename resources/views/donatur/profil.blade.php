@extends('layouts.app')

@section('title', 'Profil Saya - DonasiKita')

@section('content')
<div class="pt-[100px] pb-12 px-4 md:px-8 max-w-container-max mx-auto min-h-screen">
    
    <div class="mb-8">
        <h1 class="font-['Plus_Jakarta_Sans'] text-3xl font-extrabold text-[#0B132A]">Manajemen Akun</h1>
        <p class="text-gray-500 mt-2">Kelola informasi pribadi dan keamanan akunmu di sini.</p>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-xl bg-green-50 px-5 py-4 text-sm text-green-700 border border-green-100 flex items-center gap-3">
            <span class="material-symbols-outlined text-green-600">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 rounded-xl bg-red-50 px-5 py-4 text-sm text-red-700 border border-red-100 flex items-start gap-3">
            <span class="material-symbols-outlined text-red-600">error</span>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1 flex flex-col gap-6">
            
            <div class="bg-white rounded-3xl p-6 shadow-soft-1 border border-gray-100/50">
                <div class="flex flex-col items-center text-center">
                    <div class="w-24 h-24 bg-surface-container-high rounded-full flex items-center justify-center text-primary mb-4">
                        <span class="material-symbols-outlined text-5xl">account_circle</span>
                    </div>
                    <h3 class="font-['Plus_Jakarta_Sans'] text-xl font-bold text-gray-800">{{ $donatur->nama ?? 'Nama Donatur' }}</h3>
                    <span class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Donatur Aktif</span>
                </div>

                <hr class="my-5 border-gray-100">

                <div class="space-y-4">
                    <div class="flex items-start gap-3 text-sm text-gray-600">
                        <span class="material-symbols-outlined text-[20px] text-gray-400">mail</span>
                        <span class="break-all">{{ $donatur->email ?? 'email@contoh.com' }}</span>
                    </div>
                    <div class="flex items-start gap-3 text-sm text-gray-600">
                        <span class="material-symbols-outlined text-[20px] text-gray-400">call</span>
                        <span>{{ $donatur->no_hp ?? 'Belum ada nomor HP' }}</span>
                    </div>
                    <div class="flex items-start gap-3 text-sm text-gray-600">
                        <span class="material-symbols-outlined text-[20px] text-gray-400">home</span>
                        <span>{{ $donatur->alamat ?? 'Belum ada alamat' }}</span>
                    </div>
                    <div class="flex items-start gap-3 text-sm text-gray-600">
                        <span class="material-symbols-outlined text-[20px] text-gray-400">calendar_month</span>
                        <span>Bergabung sejak {{ isset($donatur->created_at) ? $donatur->created_at->format('d M Y') : '-' }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-[#2E3192] to-[#4B399A] rounded-3xl p-6 text-white shadow-soft-2 relative overflow-hidden">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-white/10 rounded-full"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 border-[20px] border-white/5 rounded-full"></div>
                
                <h3 class="font-['Plus_Jakarta_Sans'] text-lg font-bold mb-4 relative z-10 flex items-center gap-2">
                    <span class="material-symbols-outlined">analytics</span>
                    Dampak Kebaikanmu
                </h3>
                
                <div class="space-y-4 relative z-10">
                    <div>
                        <p class="text-blue-200 text-sm mb-1">Total Donasi Berhasil</p>
                        <p class="text-2xl font-bold">Rp {{ number_format($totalDonasi ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <hr class="border-white/20">
                    <div>
                        <p class="text-blue-200 text-sm mb-1">Jumlah Transaksi</p>
                        <p class="text-xl font-bold">{{ $jumlahTransaksi ?? 0 }} <span class="text-sm font-normal text-blue-200">kali membantu</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 flex flex-col gap-6">
            
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-soft-1 border border-gray-100/50">
                <h2 class="font-['Plus_Jakarta_Sans'] text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">manage_accounts</span>
                    Informasi Pribadi
                </h2>

                <form action="/profil/update" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @csrf
                    @method('PUT')

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $donatur->nama ?? '') }}" required class="w-full px-4 py-3 bg-[#FCFCFD] border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $donatur->email ?? '') }}" required class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-sm text-gray-500 cursor-not-allowed" readonly title="Email tidak dapat diubah">
                        <p class="text-xs text-gray-400 mt-1">*Email digunakan untuk login dan tidak dapat diubah.</p>
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nomor HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $donatur->no_hp ?? '') }}" class="w-full px-4 py-3 bg-[#FCFCFD] border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" class="w-full px-4 py-3 bg-[#FCFCFD] border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">{{ old('alamat', $donatur->alamat ?? '') }}</textarea>
                    </div>

                    <div class="md:col-span-2 mt-2 flex justify-end">
                        <button type="submit" class="bg-primary hover:bg-[#2A1D9E] text-white font-semibold px-6 py-3 rounded-full flex items-center gap-2 transition-colors">
                            <span class="material-symbols-outlined text-[20px]">save</span>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-soft-1 border border-gray-100/50">
                <h2 class="font-['Plus_Jakarta_Sans'] text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">lock</span>
                    Keamanan Akun
                </h2>

                <form action="/profil/password" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @csrf
                    @method('PUT')

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Password Saat Ini</label>
                        <input type="password" name="current_password" placeholder="Masukkan password lama" class="w-full px-4 py-3 bg-[#FCFCFD] border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan semua kolom ini jika tidak ingin mengubah password.</p>
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Password Baru</label>
                        <input type="password" name="new_password" placeholder="Minimal 6 karakter" class="w-full px-4 py-3 bg-[#FCFCFD] border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    <div class="md:col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" placeholder="Ketik ulang password baru" class="w-full px-4 py-3 bg-[#FCFCFD] border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    <div class="md:col-span-2 mt-2 flex justify-end">
                        <button type="submit" class="bg-[#0B132A] hover:bg-black text-white font-semibold px-6 py-3 rounded-full flex items-center gap-2 transition-colors">
                            <span class="material-symbols-outlined text-[20px]">key</span>
                            Perbarui Password
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection