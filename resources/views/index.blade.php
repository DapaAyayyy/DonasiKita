<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kampanye - Test Backend 2</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">
    <h1>Daftar Kampanye (Dummy View)</h1>

    {{-- Mengecek apakah Backend 1 sudah melempar variabel $kampanye dari Controller --}}
    @if(isset($kampanye) && $kampanye->count() > 0)
        @foreach($kampanye as $item)
            <div style="border: 1px solid #ccc; margin-bottom: 20px; padding: 15px; border-radius: 8px;">
                <h2>{{ $item->judul ?? 'Judul Belum Ada' }}</h2>
                
                @php
                    // Tugas Backend 2: Null handling dan kalkulasi
                    $target = $item->target_donasi ?? 0;
                    $terkumpul = $item->terkumpul ?? 0;
                    $progress = $target > 0 ? min(($terkumpul / $target) * 100, 100) : 0;
                @endphp

                <p><strong>Target:</strong> Rp{{ number_format($target, 0, ',', '.') }}</p>
                <p><strong>Terkumpul:</strong> Rp{{ number_format($terkumpul, 0, ',', '.') }}</p>

                {{-- Tugas Backend 2: Progress Bar --}}
                <div style="width: 100%; background-color: #eee; border-radius: 10px; height: 20px; margin-top: 10px;">
                    <div style="width: {{ $progress }}%; background-color: #4CAF50; height: 100%; border-radius: 10px;"></div>
                </div>
                <p style="font-size: 14px; margin-top: 5px;">{{ number_format($progress, 0) }}% Terkumpul</p>
            </div>
        @endforeach
    @else
        <p style="color: red;">Data belum ada atau variabel dari Controller belum dikirim.</p>
    @endif

</body>
</html>