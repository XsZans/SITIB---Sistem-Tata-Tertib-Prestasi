<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Anak - {{ $siswa ? $siswa->nama : 'Unknown' }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; }
        .info { margin-bottom: 20px; }
        .section { margin-bottom: 25px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .status-proses { color: #856404; }
        .status-selesai { color: #155724; }
        .no-data { text-align: center; color: #666; font-style: italic; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN DATA ANAK</h2>
        <p>SMK Negeri 1 Kota</p>
        <p>Tanggal Cetak: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    @if($siswa)
    <div class="info">
        <h3>Data Siswa</h3>
        <table>
            <tr><td width="20%"><strong>Nama</strong></td><td>{{ $siswa->nama }}</td></tr>
            <tr><td><strong>NIS</strong></td><td>{{ $siswa->nis }}</td></tr>
            <tr><td><strong>Kelas</strong></td><td>{{ $siswa->kelas }}</td></tr>
        </table>
    </div>

    <div class="section">
        <h3>Riwayat Pelanggaran</h3>
        @if($pelanggaran->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Tanggal</th>
                        <th width="18%">Jenis Pelanggaran</th>
                        <th width="20%">Deskripsi</th>
                        <th width="12%">Pencatat</th>
                        <th width="12%">Verifikator</th>
                        <th width="15%">Bukti</th>
                        <th width="8%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pelanggaran as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>{{ $item->jenisPelanggaran->nama_pelanggaran ?? 'Tidak diketahui' }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        <td>{{ $item->user->name ?? '-' }}</td>
                        <td>{{ $item->verifikator->name ?? '-' }}</td>
                        <td>{{ $item->bukti_gambar ? 'Ada' : 'Tidak ada' }}</td>
                        <td class="status-selesai">Selesai</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-data">Tidak ada data pelanggaran</p>
        @endif
    </div>

    <div class="section">
        <h3>Data Prestasi</h3>
        @if($prestasi->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Tanggal</th>
                        <th width="18%">Jenis Prestasi</th>
                        <th width="20%">Deskripsi</th>
                        <th width="12%">Pencatat</th>
                        <th width="12%">Verifikator</th>
                        <th width="15%">Bukti</th>
                        <th width="8%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prestasi as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>{{ $item->prestasi->nama ?? 'Tidak diketahui' }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        <td>{{ $item->user->name ?? '-' }}</td>
                        <td>{{ $item->verifikator->name ?? '-' }}</td>
                        <td>{{ $item->bukti_gambar ? 'Ada' : 'Tidak ada' }}</td>
                        <td class="status-selesai">Diverifikasi</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-data">Tidak ada data prestasi</p>
        @endif
    </div>

    <div class="section">
        <h3>Data Sanksi</h3>
        @if($sanksi->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Tanggal Mulai</th>
                        <th width="20%">Jenis Sanksi</th>
                        <th width="35%">Deskripsi Sanksi</th>
                        <th width="15%">Tanggal Selesai</th>
                        <th width="10%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sanksi as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->tanggal_mulai ? $item->tanggal_mulai->format('d/m/Y') : '-' }}</td>
                        <td>{{ $item->jenis_sanksi }}</td>
                        <td>{{ $item->deskripsi_sanksi }}</td>
                        <td>{{ $item->tanggal_selesai ? $item->tanggal_selesai->format('d/m/Y') : '-' }}</td>
                        <td class="{{ $item->status == 'dalam_proses' ? 'status-proses' : 'status-selesai' }}">
                            {{ $item->status == 'dalam_proses' ? 'Dalam Proses' : 'Selesai' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-data">Tidak ada data sanksi</p>
        @endif
    </div>
    @else
        <p class="no-data">Data siswa tidak ditemukan</p>
    @endif
</body>
</html>