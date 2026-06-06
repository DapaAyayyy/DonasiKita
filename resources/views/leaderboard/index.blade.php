<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Leaderboard - Test Backend 2</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">
    <h2>Top 10 Donatur (Dummy View)</h2>
    
    @if(isset($leaderboard) && count($leaderboard) > 0)
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; max-width: 600px;">
            <thead style="background-color: #f4f4f4;">
                <tr>
                    <th>Peringkat</th>
                    <th>Nama Donatur</th>
                    <th>Total Donasi (Status: Berhasil)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaderboard as $index => $juara)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $juara->nama }}</td>
                        <td style="text-align: right; color: green;">
                            <strong>Rp{{ number_format($juara->total_donasi, 0, ',', '.') }}</strong>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color: red;">Belum ada data donasi berstatus berhasil.</p>
    @endif
</body>
</html>