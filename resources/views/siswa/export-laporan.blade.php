<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Siswa - {{ $siswa->nama }}</title>
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
        .info-siswa {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .info-siswa table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-siswa td {
            padding: 5px;
            vertical-align: top;
        }
        .info-siswa td:first-child {
            font-weight: bold;
            width: 120px;
        }
        .section {
            margin-bottom: 25px;
        }
        .section h3 {
            background: #007bff;
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
        <h1>LAPORAN SISWA</h1>
        <h2>SMK Negeri 1 Cimahi</h2>
        <p>Tanggal Cetak: {{ now()->format('d F Y') }}</p>
    </div>

    <div class="info-siswa">
        <table>
            <tr>
                <td>NIS</td>
                <td>: {{ $siswa->nis }}</td>
                <td>Kelas</td>
                <td>: {{ $siswa->kelas }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>: {{ $siswa->nama }}</td>
                <td>Jurusan</td>
                <td>: {{ $siswa->jurusan }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                <td>Poin Saat Ini</td>
                <td>: <span class="poin">{{ $siswa->poin_pelanggaran }}</span> (Pelanggaran) | <span class="poin prestasi">{{ $siswa->poin_prestasi ?? 0 }}</span> (Prestasi)</td>
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
                        <th width="12%">Tanggal</th>
                        <th width="25%">Jenis Pelanggaran</th>
                        <th width="8%">Poin</th>
                        <th width="20%">Keterangan</th>
                        <th width="15%">Pelapor</th>
                        <th width="12%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pelanggaran as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->created_at->format('d/m/Y') }}</td>
                        <td>{{ $p->jenisPelanggaran->nama_pelanggaran }}</td>
                        <td class="poin">{{ $p->jenisPelanggaran->poin }}</td>
                        <td>{{ $p->keterangan ?: '-' }}</td>
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
                        <th width="12%">Tanggal</th>
                        <th width="25%">Jenis Prestasi</th>
                        <th width="10%">Tingkat</th>
                        <th width="8%">Poin</th>
                        <th width="20%">Keterangan</th>
                        <th width="17%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prestasi as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->created_at->format('d/m/Y') }}</td>
                        <td>{{ $p->prestasi->nama_prestasi }}</td>
                        <td>{{ ucfirst($p->prestasi->tingkat) }}</td>
                        <td class="poin prestasi">{{ $p->prestasi->poin_pengurangan }}</td>
                        <td>{{ $p->keterangan ?: '-' }}</td>
                        <td><span class="status diverifikasi">Diverifikasi</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">Tidak ada riwayat prestasi yang telah diverifikasi</div>
        @endif
    </div>

    @if($sanksi->count() > 0)
    <div class="section">
        <h3>Riwayat Sanksi yang Telah Selesai</h3>
        <table class="table">
            <thead>
                <tr>
                    <th width="8%">No</th>
                    <th width="15%">Tanggal Mulai</th>
                    <th width="15%">Tanggal Selesai</th>
                    <th width="20%">Jenis Sanksi</th>
                    <th width="30%">Deskripsi</th>
                    <th width="12%">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sanksi as $index => $s)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $s->tanggal_mulai ? $s->tanggal_mulai->format('d/m/Y') : '-' }}</td>
                    <td>{{ $s->tanggal_selesai ? $s->tanggal_selesai->format('d/m/Y') : '-' }}</td>
                    <td>{{ $s->jenis_sanksi }}</td>
                    <td>{{ $s->deskripsi_sanksi }}</td>
                    <td><span class="status selesai">Selesai</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="footer">
        <p>Laporan ini digenerate secara otomatis pada {{ now()->format('d F Y H:i:s') }}</p>
    </div>
</body>
</html>