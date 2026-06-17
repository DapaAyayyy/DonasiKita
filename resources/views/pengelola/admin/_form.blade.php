@csrf
@if($admin) 
    @method('PUT') 
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label class="font-bold text-sm">Nama</label>
        <input type="text" name="nama" value="{{ old('nama', $admin->nama ?? '') }}" class="w-full rounded-2xl border-slate-200 mt-2" required>
    </div>

    <div>
        <label class="font-bold text-sm">Email</label>
        <input type="email" name="email" value="{{ old('email', $admin->email ?? '') }}" class="w-full rounded-2xl border-slate-200 mt-2" required>
    </div>

    <div>
        <label class="font-bold text-sm">No HP</label>
        <input type="text" name="no_hp" value="{{ old('no_hp', $admin->no_hp ?? '') }}" class="w-full rounded-2xl border-slate-200 mt-2">
    </div>

    <div>
        <label class="font-bold text-sm">Role</label>
        <select name="role" class="w-full rounded-2xl border-slate-200 mt-2 bg-slate-50" required>
            <option value="super_admin" selected>
                Admin Utama
            </option>
        </select>
        <p class="text-xs text-slate-500 mt-1">Akun ini akan didaftarkan sebagai Admin Utama.</p>
    </div>

    <div>
        <label class="font-bold text-sm">Status</label>
        <select name="status" class="w-full rounded-2xl border-slate-200 mt-2">
            <option value="aktif" @selected(old('status', $admin->status ?? 'aktif') === 'aktif')>Aktif</option>
            <option value="nonaktif" @selected(old('status', $admin->status ?? 'aktif') === 'nonaktif')>Nonaktif</option>
        </select>
    </div>

    <div>
        <label class="font-bold text-sm">Password {{ $admin ? '(kosongkan jika tidak diganti)' : '' }}</label>
        <input type="password" name="password" class="w-full rounded-2xl border-slate-200 mt-2" @if(!$admin) required @endif>
    </div>
</div>

<div class="flex gap-3 mt-6">
    <button type="submit" class="rounded-2xl bg-[#3525cd] text-white font-bold px-6 py-3">Simpan</button>
    <a href="{{ route('pengelola.admin.index') }}" class="rounded-2xl bg-slate-100 text-slate-700 font-bold px-6 py-3">Batal</a>
</div>
