@extends('pengelola.layouts.app')

@section('title', 'Monitoring Donasi - DonasiKita')
@section('page_title', 'Monitoring Donasi')

@section('content')
<div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-5 mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari donatur, kampanye, order ID" class="rounded-2xl border-slate-200">
        <select name="status" class="rounded-2xl border-slate-200">
            <option value="">Semua status</option>
            @foreach($statusOptions as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
        <select name="kampanye" class="rounded-2xl border-slate-200">
            <option value="">Semua kampanye</option>
            @foreach($kampanyeOptions as $kampanye)
                <option value="{{ $kampanye->id_kampanye }}" @selected((string) request('kampanye') === (string) $kampanye->id_kampanye)>{{ $kampanye->judul_kampanye }}</option>
            @endforeach
        </select>
        <button class="rounded-2xl bg-[#3525cd] text-white font-bold px-5 py-2" type="submit">Filter</button>
    </form>
</div>

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead class="bg-slate-50 text-left text-xs uppercase tracking-wider text-slate-500">
                <tr>
                    <th class="px-5 py-4">Donatur</th>
                    <th class="px-5 py-4">Kampanye</th>
                    <th class="px-5 py-4">Nominal</th>
                    <th class="px-5 py-4">Metode</th>
                    <th class="px-5 py-4">Status</th>
                    <th class="px-5 py-4">Tanggal</th>
                    <th class="px-5 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($donasi as $item)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-4 font-semibold">{{ $item->donatur->nama ?? '-' }}<div class="text-xs text-slate-400">{{ $item->midtrans_order_id ?? 'Tanpa order ID' }}</div></td>
                        <td class="px-5 py-4 max-w-xs truncate">{{ $item->kampanye->judul_kampanye ?? '-' }}</td>
                        <td class="px-5 py-4 font-bold text-[#3525cd] whitespace-nowrap">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                        <td class="px-5 py-4">{{ $item->metodePembayaran->nama_metode ?? $item->payment_type ?? '-' }}</td>
                        <td class="px-5 py-4"><x-pengelola-status :status="$item->status_donasi" /></td>
                        <td class="px-5 py-4 text-sm text-slate-500">{{ $item->tanggal_donasi ? \Carbon\Carbon::parse($item->tanggal_donasi)->format('d M Y H:i') : '-' }}</td>
                        <td class="px-5 py-4 text-right"><a href="{{ route('pengelola.donasi.show', $item) }}" class="font-bold text-[#3525cd]">Detail</a></td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-5 py-12 text-center text-slate-500">Belum ada transaksi donasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-5 border-t border-slate-100">{{ $donasi->links() }}</div>
</div>
@endsection
