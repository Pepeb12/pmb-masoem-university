<!DOCTYPE html>
<html>
<head>
    <title>Kartu Tanda Mahasiswa Sementara</title>
    <style>
        body { font-family: sans-serif; }
        .card { border: 2px solid #000; padding: 20px; width: 100%; max-width: 600px; margin: 0 auto; }
        .header { text-align: center; border-bottom: 2px double #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { margin: 0; color: #003366; } /* Warna Biru Masoem */
        .info-table { width: 100%; }
        .info-table td { padding: 5px; vertical-align: top; }
        .foto { width: 120px; height: 160px; border: 1px solid #000; object-fit: cover; }
    </style>
</head>
<body>

    <div class="card">
        <div class="header">
            <h2>MASOEM UNIVERSITY</h2>
            <p>Kartu Tanda Mahasiswa Sementara</p>
        </div>

        <table class="info-table">
            <tr>
                <td width="30%" rowspan="5">
                    @if($mahasiswa->foto)
                        <img src="{{ public_path('storage/' . $mahasiswa->foto) }}" class="foto">
                    @else
                        <div style="width:120px; height:160px; border:1px solid #000; text-align:center; line-height:160px;">No Foto</div>
                    @endif
                </td>
                <td width="20%"><strong>NIM</strong></td>
                <td>: {{ $mahasiswa->nim }}</td>
            </tr>
            <tr>
                <td><strong>Nama</strong></td>
                <td>: {{ $mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td><strong>Prodi</strong></td>
                <td>: {{ $mahasiswa->pilihan_prodi_1 ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Angkatan</strong></td>
                <td>: {{ $mahasiswa->angkatan }}</td>
            </tr>
            <tr>
                <td><strong>Status</strong></td>
                <td>: {{ ucfirst($mahasiswa->status) }}</td>
            </tr>
        </table>

        <div style="margin-top: 30px; text-align: center;">
            <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(100)->generate($mahasiswa->nim . ' - ' . $mahasiswa->nama)) !!}" width="100" height="100">
            <p style="font-size: 10px;">Scan untuk verifikasi</p>
        </div>
    </div>

</body>
</html>