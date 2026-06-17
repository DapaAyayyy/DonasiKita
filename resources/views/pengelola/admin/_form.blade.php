@csrf
@if($admin) 
    @method('PUT') 
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <!-- Nama -->
    <div>
        <label class="font-bold text-sm">Nama</label>
        <input type="text" name="nama" value="{{ old('nama', $admin->nama ?? '') }}" class="w-full rounded-2xl border-slate-200 mt-2" required>
    </div>

    <!-- Email -->
    <div>
        <label class="font-bold text-sm">Email</label>
        <input type="email" name="email" value="{{ old('email', $admin->email ?? '') }}" class="w-full rounded-2xl border-slate-200 mt-2" required>
    </div>

    <!-- No HP -->
    <div>
        <label class="font-bold text-sm">No HP</label>
        <input type="text" name="no_hp" value="{{ old('no_hp', $admin->no_hp ?? '') }}" class="w-full rounded-2xl border-slate-200 mt-2">
    </div>

    <!-- Role -->
    <div>
        <label class="font-bold text-sm">Role</label>
        <select name="role" class="w-full rounded-2xl border-slate-200 mt-2" required>
            <option value="pengelola" @selected(old('role', $admin->role ?? 'pengelola') === 'pengelola')}>
                Pengelola
            </option>
            <option value="super_admin" @selected(old('role', $admin->role ?? '') === 'super_admin')}>
                Admin Utama
            </option>
        </select>
        <p class="text-xs text-slate-500 mt-1">Admin Utama dapat mengelola akun admin. Pengelola biasa tidak bisa.</p>
    </div>

    <!-- Status -->
    <div>
        <label class="font-bold text-sm">Status</label>
        <select name="status" class="w-full rounded-2xl border-slate-200 mt-2">
            <option value="aktif" @selected(old('status', $admin->status ?? 'aktif') === 'aktif')}>Aktif</option>
            <option value="nonaktif" @selected(old('status', $admin->status ?? 'aktif') === 'nonaktif')}>Nonaktif</option>
        </select>
    </div>

    <!-- Password -->
    <div>
        <label class="font-bold text-sm">Password {{ $admin ? '(kosongkan jika tidak diganti)' : '' }}</label>
        <input type="password" name="password" class="w-full rounded-2xl border-slate-200 mt-2" @if(!$admin) required @endif>
    </div>
</div>

<!-- Tombol Aksi -->
<div class="flex gap-3 mt-6">
    <button type="submit" class="rounded-2xl bg-[#3525cd] text-white font-bold px-6 py-3">Simpan</button>
    <a href="{{ route('pengelola.admin.index') }}" class="rounded-2xl bg-slate-100 text-slate-700 font-bold px-6 py-3">Batal</a>
</div>
