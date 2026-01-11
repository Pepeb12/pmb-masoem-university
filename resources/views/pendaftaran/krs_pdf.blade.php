<!DOCTYPE html>
<html>
<head>
    <title>KRS Semester 1</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 11pt; }
        .header { text-align: center; border-bottom: 2px double black; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { margin: 0; font-size: 16pt; text-transform: uppercase; }
        .header h3 { margin: 5px 0; font-size: 12pt; }
        
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table td { padding: 3px; vertical-align: top; }
        
        .matkul-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .matkul-table th, .matkul-table td { border: 1px solid black; padding: 6px; }
        .matkul-table th { background-color: #f0f0f0; text-align: center; }
        .center { text-align: center; }
        
        .footer { width: 100%; margin-top: 40px; }
        .ttd { float: right; width: 250px; text-align: center; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Masoem University</h2>
        <h3>KARTU RENCANA STUDI (KRS)</h3>
        <p>Semester Ganjil - Tahun Akademik {{ date('Y') }}/{{ date('Y')+1 }}</p>
    </div>

    <table class="info-table">
        <tr>
            <td width="15%"><strong>Nama</strong></td>
            <td width="2%">:</td>
            <td width="40%">{{ $mahasiswa->nama }}</td>
            <td width="15%"><strong>Program Studi</strong></td>
            <td width="2%">:</td>
            <td>{{ $mahasiswa->pilihan_prodi_1 }}</td>
        </tr>
        <tr>
            <td><strong>NIM</strong></td>
            <td>:</td>
            <td>{{ $mahasiswa->nim }}</td>
            <td><strong>Semester</strong></td>
            <td>:</td>
            <td>1 (Satu)</td>
        </tr>
    </table>

    <table class="matkul-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Kode MK</th>
                <th>Mata Kuliah</th>
                <th width="10%">SKS</th>
                <th width="15%">Ket</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matkul as $index => $mk)
            <tr>
                <td class="center">{{ $index + 1 }}</td>
                <td class="center">{{ $mk['kode'] }}</td>
                <td>{{ $mk['nama'] }}</td>
                <td class="center">{{ $mk['sks'] }}</td>
                <td class="center">Baru</td>
            </tr>
            @endforeach
            <tr style="font-weight: bold; background-color: #f9f9f9;">
                <td colspan="3" style="text-align: right; padding-right: 10px;">Total SKS yang diambil</td>
                <td class="center">{{ $totalSks }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <div class="ttd">
            <p>Sumedang, {{ date('d F Y') }}</p>
            <p>Dosen Wali,</p>
            <br><br><br>
            <p><strong>_______________________</strong></p>
            <p>NIP. .......................</p>
        </div>
        <div style="float: left; width: 250px; text-align: center;">
            <p>Mahasiswa,</p>
            <br><br><br>
            <p><strong>{{ $mahasiswa->nama }}</strong></p>
            <p>NIM. {{ $mahasiswa->nim }}</p>
        </div>
    </div>

</body>
</html>