<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }
        .header h2 {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }
        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .info-table td {
            padding: 3px 0;
            vertical-align: top;
        }
        .info-table .label {
            width: 120px;
            font-weight: bold;
        }
        .section {
            margin-bottom: 25px;
        }
        .section h3 {
            background-color: #f5f5f5;
            padding: 8px;
            margin: 0 0 10px 0;
            font-size: 14px;
            border-left: 4px solid #ea580c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            font-size: 11px;
        }
        td {
            font-size: 10px;
        }
        .text-center {
            text-align: center;
        }
        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }
        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <h2>Guru: {{ $guru->nama }}</h2>
        @if($periode === 'bulan' && $bulan)
            <p>Periode: {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}</p>
        @elseif($periode === 'tahun')
            <p>Periode: Tahun {{ $tahun }}</p>
        @else
            <p>Periode: Semua Data</p>
        @endif
    </div>

    <div class="section">
        <h3>Informasi Siswa</h3>
        <table class="info-table">
            <tr>
                <td class="label">Nama Siswa:</td>
                <td>{{ $siswa->nama }}</td>
            </tr>
            <tr>
                <td class="label">NIS:</td>
                <td>{{ $siswa->nis }}</td>
            </tr>
            <tr>
                <td class="label">Kelas:</td>
                <td>{{ $siswa->kelas }}</td>
            </tr>
            <tr>
                <td class="label">Jurusan:</td>
                <td>{{ $siswa->jurusan }}</td>
            </tr>
            <tr>
                <td class="label">Poin Pelanggaran:</td>
                <td>{{ $siswa->poin_pelanggaran }}</td>
            </tr>
        </table>
    </div>

    @if($pelanggaran->count() > 0)
    <div class="section">
        <h3>Riwayat Pelanggaran ({{ $pelanggaran->count() }} kasus)</h3>
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Jenis Pelanggaran</th>
                    <th width="15%">Kategori</th>
                    <th width="10%">Poin</th>
                    <th width="15%">Tanggal</th>
                    <th width="20%">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pelanggaran as $index => $p)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $p->jenisPelanggaran->nama_pelanggaran }}</td>
                    <td>{{ $p->jenisPelanggaran->kategori }}</td>
                    <td class="text-center">
                        <span class="badge badge-danger">{{ $p->jenisPelanggaran->poin }}</span>
                    </td>
                    <td>{{ $p->created_at->format('d/m/Y') }}</td>
                    <td>{{ $p->keterangan ?: '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="section">
        <h3>Riwayat Pelanggaran</h3>
        <p style="text-align: center; color: #666; padding: 20px;">Tidak ada riwayat pelanggaran untuk periode ini.</p>
    </div>
    @endif

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
        <p>Guru: {{ $guru->nama }}</p>
    </div>
</body>
</html>