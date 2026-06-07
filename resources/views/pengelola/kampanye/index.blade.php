@extends('pengelola.layouts.app')
@section('title','Kelola Kampanye - DonasiKita')
@section('page_title','Kelola Kampanye')
@section('content')
<div class="flex flex-col md:flex-row gap-3 justify-between mb-6">
    <form method="GET" class="flex flex-col md:flex-row gap-3 flex-1">
        <input name="q" value="{{ request('q') }}" placeholder="Cari judul kampanye" class="rounded-2xl border-slate-200 md:max-w-sm">
        <select name="status" class="rounded-2xl border-slate-200 md:max-w-xs"><option value="">Semua status</option>@foreach($statusOptions as $status)<option value="{{ $status }}" @selected(request('status')===$status)>{{ ucfirst($status) }}</option>@endforeach</select>
        <button class="rounded-2xl bg-slate-900 text-white font-bold px-5">Filter</button>
    </form>
    <a href="{{ route('pengelola.kampanye.create') }}" class="rounded-2xl bg-[#3525cd] text-white font-bold px-5 py-3 text-center">+ Tambah Kampanye</a>
</div>
<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden"><div class="overflow-x-auto"><table class="min-w-full divide-y divide-slate-100"><thead class="bg-slate-50 text-left text-xs uppercase text-slate-500"><tr><th class="px-5 py-4">Kampanye</th><th class="px-5 py-4">Penerima</th><th class="px-5 py-4">Target</th><th class="px-5 py-4">Terkumpul</th><th class="px-5 py-4">Status</th><th class="px-5 py-4 text-right">Aksi</th></tr></thead><tbody class="divide-y divide-slate-100">@forelse($kampanye as $item)<tr class="hover:bg-slate-50"><td class="px-5 py-4 font-bold max-w-sm truncate">{{ $item->judul_kampanye }}<div class="text-xs text-slate-400">Deadline: {{ $item->deadline }}</div></td><td class="px-5 py-4">{{ $item->penerima->nama ?? '-' }}</td><td class="px-5 py-4">Rp {{ number_format($item->target_donasi,0,',','.') }}</td><td class="px-5 py-4 font-bold text-[#3525cd]">Rp {{ number_format($item->terkumpul,0,',','.') }}</td><td class="px-5 py-4"><x-pengelola-status :status="$item->status" /></td><td class="px-5 py-4 text-right whitespace-nowrap"><a class="font-bold text-[#3525cd]" href="{{ route('pengelola.kampanye.show',$item) }}">Detail</a><span class="text-slate-300 mx-2">|</span><a class="font-bold text-amber-600" href="{{ route('pengelola.kampanye.edit',$item) }}">Edit</a></td></tr>@empty<tr><td colspan="6" class="px-5 py-12 text-center text-slate-500">Belum ada kampanye.</td></tr>@endforelse</tbody></table></div><div class="p-5 border-t border-slate-100">{{ $kampanye->links() }}</div></div>
@endsection
