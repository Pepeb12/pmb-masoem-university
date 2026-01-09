<!DOCTYPE html>
<html>
<head>
    <title>Kartu Ujian - {{ $mahasiswa->nim }}</title>
    <style>
        body { font-family: sans-serif; padding: 40px; }
        .card { border: 2px solid #000; width: 600px; padding: 20px; margin: 0 auto; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .logo { font-size: 24px; font-weight: bold; }
        .info { display: flex; }
        .photo { width: 150px; height: 180px; background: #ddd; object-fit: cover; border: 1px solid #000; margin-right: 20px; }
        .details table { width: 100%; }
        .details td { padding: 5px; }
        .footer { margin-top: 30px; text-align: right; font-size: 12px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <button onclick="window.print()" class="no-print" style="margin-bottom: 20px; padding: 10px;">Cetak Kartu</button>

    <div class="card">
        <div class="header">
            <div class="logo">KARTU PESERTA UJIAN</div>
            <div>PMB MASOEM UNIVERSITY 2026</div>
        </div>

        <div class="info">
            <img src="{{ asset('storage/' . $mahasiswa->foto) }}" class="photo">
            
            <div class="details">
                <table>
                    <tr>
                        <td><strong>No. Registrasi</strong></td>
                        <td>: {{ $mahasiswa->nim }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama Peserta</strong></td>
                        <td>: {{ $mahasiswa->nama }}</td>
                    </tr>
                    <tr>
                        <td><strong>Program Studi</strong></td>
                        <td>: {{ $mahasiswa->prodi->nama_prodi }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jadwal Ujian</strong></td>
                        <td>: 10 Januari 2026</td>
                    </tr>
                    <tr>
                        <td><strong>Lokasi</strong></td>
                        <td>: Lab Komputer 1</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="footer">
            <p>Dicetak pada: {{ now()->format('d M Y H:i') }}</p>
            <p>Panitia PMB</p>
        </div>
    </div>
</body>
</html>