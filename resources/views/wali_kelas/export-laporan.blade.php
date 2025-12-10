<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
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
        .info-kelas {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .info-kelas table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-kelas td {
            padding: 5px;
            vertical-align: top;
        }
        .info-kelas td:first-child {
            font-weight: bold;
            width: 120px;
        }
        .section {
            margin-bottom: 25px;
        }
        .section h3 {
            background: #7c3aed;
            color: white;
            padding: 8px 12px;
            margin: 0 0 15px 0;
            font-size: 14px;
            border-radius: 3px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
            font-size: 11px;
        }
        .table td {
            font-size: 10px;
        }
        .status {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
            color: white;
        }
        .status.selesai { background-color: #28a745; }
        .status.diverifikasi { background-color: #28a745; }
        .poin {
            font-weight: bold;
            color: #dc3545;
        }
        .poin.prestasi {
            color: #28a745;
        }
        .no-data {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 20px;
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
        <h2>SMK Negeri 1 Cimahi</h2>
        <p>Tanggal Cetak: {{ now()->format('d F Y') }}</p>
    </div>

    <div class="info-kelas">
        <table>
            <tr>
                <td>Wali Kelas</td>
                <td>: {{ $guru->nama }}</td>
                <td>Kelas</td>
                <td>: {{ $guru->wali_kelas }}</td>
            </tr>
            <tr>
                <td>NIP</td>
                <td>: {{ $guru->nip }}</td>
                <td>Periode</td>
                <td>: 
                    @if($periode === 'bulan')
                        {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}
                    @elseif($periode === 'tahun')
                        Tahun {{ $tahun }}
                    @else
                        Semua Data
                    @endif
                </td>
            </tr>
            <tr>
                <td>Total Siswa</td>
                <td>: {{ $siswaList->count() }}</td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h3>Riwayat Pelanggaran yang Telah Selesai</h3>
        @if($pelanggaran->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th width="8%">No</th>
                        <th width="20%">Nama Siswa</th>
                        <th width="12%">Tanggal</th>
                        <th width="25%">Jenis Pelanggaran</th>
                        <th width="8%">Poin</th>
                        <th width="15%">Pelapor</th>
                        <th width="12%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pelanggaran as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->siswa->nama }}</td>
                        <td>{{ $p->created_at->format('d/m/Y') }}</td>
                        <td>{{ $p->jenisPelanggaran->nama_pelanggaran }}</td>
                        <td class="poin">{{ $p->jenisPelanggaran->poin }}</td>
                        <td>{{ $p->user->name ?? 'Sistem' }}</td>
                        <td><span class="status selesai">Selesai</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">Tidak ada riwayat pelanggaran yang telah selesai</div>
        @endif
    </div>

    <div class="section">
        <h3>Riwayat Prestasi yang Telah Diverifikasi</h3>
        @if($prestasi->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th width="8%">No</th>
                        <th width="20%">Nama Siswa</th>
                        <th width="12%">Tanggal</th>
                        <th width="25%">Jenis Prestasi</th>
                        <th width="10%">Tingkat</th>
                        <th width="8%">Poin</th>
                        <th width="17%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prestasi as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->siswa->nama }}</td>
                        <td>{{ $p->created_at->format('d/m/Y') }}</td>
                        <td>{{ $p->prestasi->nama_prestasi }}</td>
                        <td>{{ ucfirst($p->prestasi->tingkat) }}</td>
                        <td class="poin prestasi">{{ $p->prestasi->poin_pengurangan }}</td>
                        <td><span class="status diverifikasi">Diverifikasi</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">Tidak ada riwayat prestasi yang telah diverifikasi</div>
        @endif
    </div>

    <div class="footer">
        <p>Laporan ini digenerate secara otomatis pada {{ now()->format('d F Y H:i:s') }}</p>
        <p>Wali Kelas: {{ $guru->nama }}</p>
    </div>
</body>
</html>