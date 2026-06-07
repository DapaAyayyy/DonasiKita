@props(['status'])
@php
    $tone = match($status) {
        'berhasil', 'aktif', 'selesai' => 'bg-green-100 text-green-700',
        'pending' => 'bg-yellow-100 text-yellow-700',
        'gagal', 'expired', 'cancelled', 'dibatalkan', 'nonaktif' => 'bg-red-100 text-red-700',
        default => 'bg-slate-100 text-slate-700',
    };
@endphp
<span {{ $attributes->merge(['class' => "inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold {$tone}"]) }}>{{ ucfirst($status ?? '-') }}</span>
