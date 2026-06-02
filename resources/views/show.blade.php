<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kampanye - Test Backend 2</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">
    <a href="/kampanye" style="text-decoration: none; color: blue;">&larr; Kembali ke Daftar Kampanye</a>
    
    {{-- Mengecek apakah Controller sudah melempar data $kampanye --}}
    @if(isset($kampanye))
        <div style="border: 1px solid #ccc; padding: 20px; border-radius: 8px; margin-top: 15px;">
            
            {{-- Data Utama Kampanye --}}
            <h1>{{ $kampanye->judul ?? 'Judul Tidak Tersedia' }}</h1>
            <p><strong>Deskripsi:</strong> {{ $kampanye->deskripsi ?? 'Belum ada deskripsi.' }}</p>
            
            <hr style="margin: 20px 0;">

            {{-- Menampilkan Relasi Penerima (Tugas Backend 2) --}}
            <p><strong>Penerima Donasi:</strong> <span style="background-color: #e0f7fa; padding: 3px 8px; border-radius: 4px;">{{ $kampanye->penerima->nama ?? 'Data penerima belum diatur' }}</span></p>

            {{-- Kalkulasi Progress Bar --}}
            @php
                $target = $kampanye->target_donasi ?? 0;
                $terkumpul = $kampanye->terkumpul ?? 0;
                $progress = $target > 0 ? min(($terkumpul / $target) * 100, 100) : 0;
            @endphp

            <p><strong>Target:</strong> Rp{{ number_format($target, 0, ',', '.') }}</p>
            <p><strong>Terkumpul:</strong> Rp{{ number_format($terkumpul, 0, ',', '.') }}</p>

            {{-- Progress Bar UI --}}
            <div style="width: 100%; background-color: #eee; border-radius: 10px; height: 20px; margin-top: 10px;">
                <div style="width: {{ $progress }}%; background-color: #4CAF50; height: 100%; border-radius: 10px;"></div>
            </div>
            <p style="font-size: 14px; margin-top: 5px;">{{ number_format($progress, 0) }}% Terkumpul</p>
            
            <button style="margin-top: 15px; padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Donasi Sekarang (Tombol Sementara)</button>

            <hr style="margin: 20px 0;">

            {{-- Menampilkan Relasi Riwayat Donasi (Tugas Backend 2) --}}
            <h3>Riwayat Donasi:</h3>
            @if(isset($kampanye->donasi) && $kampanye->donasi->count() > 0)
                <ul style="list-style-type: none; padding: 0;">
                    @foreach($kampanye->donasi as $donatur)
                        <li style="padding: 10px; border-bottom: 1px solid #eee;">
                            {{-- Null handling jika nama anonim dan relasi nominal --}}
                            <strong>{{ $donatur->nama ?? 'Hamba Allah' }}</strong> berdonasi sebesar 
                            <strong style="color: green;">Rp{{ number_format($donatur->nominal ?? 0, 0, ',', '.') }}</strong>
                            <br>
                            <small style="color: gray;">Status: {{ $donatur->status_donasi ?? 'Pending' }}</small>
                        </li>
                    @endforeach
                </ul>
            @else
                <p style="color: gray;">Belum ada donasi untuk kampanye ini.</p>
            @endif

        </div>
    @else
        <p style="color: red;">Data kampanye tidak ditemukan. Pastikan URL menggunakan ID yang benar dan Controller sudah mengirim variabel $kampanye.</p>
    @endif

</body>
</html>