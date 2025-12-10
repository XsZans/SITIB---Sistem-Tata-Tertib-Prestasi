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
            border-left: 4px solid #007bff;
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
        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
        }
        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .summary {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .summary-item {
            display: inline-block;
            margin-right: 30px;
            text-align: center;
        }
        .summary-number {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
        .summary-label {
            font-size: 11px;
            color: #666;
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
        <h2>Wali Kelas: {{ $guru->nama }}</h2>
        @if($periode === 'bulan' && $bulan)
            <p>Periode: {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}</p>
        @elseif($periode === 'tahun')
            <p>Periode: Tahun {{ $tahun }}</p>
        @else
            <p>Periode: Semua Data</p>
        @endif
    </div>

    <div class="summary">
        <div class="summary-item">
            <div class="summary-number">{{ $siswaList->count() }}</div>
            <div class="summary-label">Total Siswa</div>
        </div>
        <div class="summary-item">
            <div class="summary-number">{{ $pelanggaran->count() }}</div>
            <div class="summary-label">Total Pelanggaran</div>
        </div>
        <div class="summary-item">
            <div class="summary-number">{{ $prestasi->count() }}</div>
            <div class="summary-label">Total Prestasi</div>
        </div>
    </div>

    <div class="section">
        <h3>Data Siswa Kelas</h3>
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">NIS</th>
                    <th width="25%">Nama Siswa</th>
                    <th width="15%">Jurusan</th>
                    <th width="15%">Poin Pelanggaran</th>
                    <th width="15%">Poin Prestasi</th>
                    <th width="10%">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswaList as $index => $siswa)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $siswa->nis }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->jurusan }}</td>
                    <td class="text-center">
                        @if($siswa->poin_pelanggaran > 0)
                            <span class="badge badge-danger">{{ $siswa->poin_pelanggaran }}</span>
                        @else
                            <span class="badge badge-success">0</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($siswa->poin_prestasi > 0)
                            <span class="badge badge-success">{{ $siswa->poin_prestasi }}</span>
                        @else
                            <span class="badge badge-warning">0</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($siswa->poin_pelanggaran == 0 && $siswa->poin_prestasi > 0)
                            <span class="badge badge-success">Baik</span>
                        @elseif($siswa->poin_pelanggaran > 0)
                            <span class="badge badge-danger">Perlu Perhatian</span>
                        @else
                            <span class="badge badge-warning">Normal</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($pelanggaran->count() > 0)
    <div class="section">
        <h3>Riwayat Pelanggaran</h3>
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Nama Siswa</th>
                    <th width="30%">Jenis Pelanggaran</th>
                    <th width="10%">Poin</th>
                    <th width="15%">Tanggal</th>
                    <th width="20%">Kategori</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pelanggaran as $index => $p)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $p->siswa->nama }}</td>
                    <td>{{ $p->jenisPelanggaran->nama_pelanggaran }}</td>
                    <td class="text-center">
                        @if($p->jenisPelanggaran->poin <= 5)
                            <span class="badge badge-warning">{{ $p->jenisPelanggaran->poin }}</span>
                        @elseif($p->jenisPelanggaran->poin <= 15)
                            <span class="badge badge-warning">{{ $p->jenisPelanggaran->poin }}</span>
                        @else
                            <span class="badge badge-danger">{{ $p->jenisPelanggaran->poin }}</span>
                        @endif
                    </td>
                    <td>{{ $p->created_at->format('d/m/Y') }}</td>
                    <td>{{ $p->jenisPelanggaran->kategori }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if($prestasi->count() > 0)
    <div class="section">
        <h3>Riwayat Prestasi</h3>
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Nama Siswa</th>
                    <th width="30%">Jenis Prestasi</th>
                    <th width="10%">Poin</th>
                    <th width="15%">Tanggal</th>
                    <th width="20%">Kategori</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prestasi as $index => $p)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $p->siswa->nama }}</td>
                    <td>{{ $p->prestasi->nama }}</td>
                    <td class="text-center">
                        <span class="badge badge-success">{{ $p->prestasi->poin_pengurangan }}</span>
                    </td>
                    <td>{{ $p->created_at->format('d/m/Y') }}</td>
                    <td>{{ $p->prestasi->kategori }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
        <p>Wali Kelas: {{ $guru->nama }}</p>
    </div>
</body>
</html>