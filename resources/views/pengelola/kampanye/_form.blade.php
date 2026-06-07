@csrf
@if($kampanye) @method('PUT') @endif
<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div><label class="font-bold text-sm">Penerima Manfaat</label><select name="id_penerima" class="w-full rounded-2xl border-slate-200 mt-2" required>@foreach($penerimaOptions as $penerima)<option value="{{ $penerima->id_penerima }}" @selected(old('id_penerima',$kampanye->id_penerima ?? '')==$penerima->id_penerima)>{{ $penerima->nama }}</option>@endforeach</select></div>
    <div><label class="font-bold text-sm">Status</label><select name="status" class="w-full rounded-2xl border-slate-200 mt-2" required>@foreach($statusOptions as $status)<option value="{{ $status }}" @selected(old('status',$kampanye->status ?? 'pending')===$status)>{{ ucfirst($status) }}</option>@endforeach</select></div>
    <div class="md:col-span-2"><label class="font-bold text-sm">Judul Kampanye</label><input name="judul_kampanye" value="{{ old('judul_kampanye',$kampanye->judul_kampanye ?? '') }}" class="w-full rounded-2xl border-slate-200 mt-2" required maxlength="200"></div>
    <div><label class="font-bold text-sm">Target Donasi</label><input type="number" name="target_donasi" value="{{ old('target_donasi',$kampanye->target_donasi ?? '') }}" class="w-full rounded-2xl border-slate-200 mt-2" required min="1"></div>
    <div><label class="font-bold text-sm">Deadline</label><input type="date" name="deadline" value="{{ old('deadline',$kampanye->deadline ?? '') }}" class="w-full rounded-2xl border-slate-200 mt-2" required></div>
    <div><label class="font-bold text-sm">Nama File Foto Sampul</label><input name="foto_sampul" value="{{ old('foto_sampul',$kampanye->foto_sampul ?? '') }}" class="w-full rounded-2xl border-slate-200 mt-2" placeholder="banjir.jpg"></div>
    <div><label class="font-bold text-sm">Upload Foto Sampul</label><input type="file" name="foto_sampul_file" accept="image/*" class="w-full rounded-2xl border-slate-200 mt-2"></div>
    <div class="md:col-span-2"><label class="font-bold text-sm">Deskripsi</label><textarea name="deskripsi" rows="7" class="w-full rounded-2xl border-slate-200 mt-2" required>{{ old('deskripsi',$kampanye->deskripsi ?? '') }}</textarea></div>
</div>
<div class="flex gap-3 mt-6"><button class="rounded-2xl bg-[#3525cd] text-white font-bold px-6 py-3">Simpan</button><a href="{{ route('pengelola.kampanye.index') }}" class="rounded-2xl bg-slate-100 text-slate-700 font-bold px-6 py-3">Batal</a></div>
