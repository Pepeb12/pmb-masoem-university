<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Calon Mahasiswa</title>
    <style>
        body { font-family: sans-serif; font-size: 10pt; }
        h2 { text-align: center; margin-bottom: 5px; }
        p { text-align: center; margin-top: 0; font-size: 10pt; color: #555; }
        hr { border: 0; border-top: 1px solid #000; margin-bottom: 20px; }
        
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #000; padding: 6px; text-align: left; vertical-align: middle; }
        .table th { background-color: #f2f2f2; text-align: center; font-weight: bold; }
        
        .footer { width: 100%; margin-top: 30px; }
        .ttd-box { float: right; width: 250px; text-align: center; }
        
        .status-lulus { color: green; font-weight: bold; }
        .status-baru { color: orange; font-weight: bold; }
        .status-tolak { color: red; font-weight: bold; }
        
        /* Helper untuk gambar QR di tengah */
        .qr-cell { text-align: center; padding: 15px !important; }
    </style>
</head>
<body>

    <h2>LAPORAN DATA CALON MAHASISWA</h2>
    <p>MASOEM UNIVERSITY - TAHUN AJARAN {{ date('Y') }}</p>
    <hr>

    <table class="table">
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 15%">NIM</th>
                <th style="width: 20%">Nama Lengkap</th>
                <th style="width: 20%">Prodi Pilihan</th>
                <th style="width: 10%">Angkatan</th>
                <th style="width: 10%">Status</th>
                <th style="width: 20%">QR Code</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswa as $index => $mhs)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td style="text-align: center;">{{ $mhs->nim }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->pilihan_prodi_1 }}</td>
                <td style="text-align: center;">{{ $mhs->angkatan }}</td>
                
                <td style="text-align: center;">
                    @if($mhs->status == 'diverifikasi')
                        <span class="status-lulus">Lulus</span>
                    @elseif($mhs->status == 'ditolak')
                        <span class="status-tolak">Ditolak</span>
                    @else
                        <span class="status-baru">Baru</span>
                    @endif
                </td>

                <td class="qr-cell">
                    <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(60)->generate($mhs->nim . ' - ' . $mhs->nama)) !!}" width="60" height="60">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <div class="ttd-box">
            <p>Sumedang, {{ date('d F Y') }}</p>
            <p>Mengetahui, Ketua PMB</p>
            
            <div style="margin: 10px 0;">
                <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::format('svg')->size(80)->generate('Dokumen Sah - ' . date('d-m-Y H:i'))) !!}" width="80" height="80">
            </div>

            <p><strong>( Admin PMB )</strong></p>
        </div>
    </div>

</body>
</html>