<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan BK</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .subtitle {
            font-size: 14px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .no {
            width: 5%;
            text-align: center;
        }
        .nama {
            width: 20%;
        }
        .kelas {
            width: 10%;
        }
        .jadwal {
            width: 15%;
        }
        .alasan {
            width: 25%;
        }
        .hasil {
            width: 25%;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">LAPORAN BIMBINGAN KONSELING</div>
        <div class="subtitle">Periode: {{ date('d/m/Y') }}</div>
        <div>Guru BK: {{ $guru->nama }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="no">No</th>
                <th class="nama">Nama Siswa</th>
                <th class="kelas">Kelas</th>
                <th style="width: 12%;">Jenis</th>
                <th class="jadwal">Tanggal BK</th>
                <th class="alasan">Alasan</th>
                <th class="hasil">Hasil BK</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sessions as $index => $session)
            <tr>
                <td class="no">{{ $index + 1 }}</td>
                <td class="nama">{{ $session->siswa->nama }}</td>
                <td class="kelas">{{ $session->siswa->kelas }}</td>
                <td style="{{ $session->jenis == 'pengajuan_siswa' ? 'background-color: #dbeafe; font-weight: bold;' : 'background-color: #fef3c7; font-weight: bold;' }}">
                    {{ $session->jenis == 'panggilan_bk' ? 'Panggilan BK' : 'Permintaan Siswa' }}
                </td>
                <td class="jadwal">{{ date('d/m/Y H:i', strtotime($session->jadwal_bk)) }}</td>
                <td class="alasan">{{ $session->alasan }}</td>
                <td class="hasil">{{ $session->hasil_bk }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Sesi BK: {{ $sessions->count() }}</p>
        <br><br>
        <p>{{ date('d/m/Y') }}</p>
        <p>Guru BK</p>
        <br><br><br>
        <p>{{ $guru->nama }}</p>
        <p>NIP: {{ $guru->nip }}</p>
    </div>
</body>
</html>