<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; font-weight: bold; }
        .text-center { text-align: center; }
        .poin-ringan { background-color: #fef3c7; }
        .poin-sedang { background-color: #fed7aa; }
        .poin-berat { background-color: #fecaca; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">{{ $title }}</div>
        <div>SMK Bakti Nusantara 666</div>
        <div>Tanggal Cetak: {{ now()->format('d/m/Y H:i') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="20%">Nama Siswa</th>
                <th width="10%">Kelas</th>
                <th width="30%">Jenis Pelanggaran</th>
                <th width="10%">Poin</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pelanggaran as $index => $p)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $p->created_at->format('d/m/Y') }}</td>
                <td>{{ $p->siswa->nama ?? '-' }}</td>
                <td>{{ $p->siswa->kelas ?? '-' }}</td>
                <td>{{ $p->jenisPelanggaran->nama_pelanggaran ?? '-' }}</td>
                <td class="text-center 
                    @if($p->jenisPelanggaran && $p->jenisPelanggaran->poin <= 5) poin-ringan
                    @elseif($p->jenisPelanggaran && $p->jenisPelanggaran->poin <= 15) poin-sedang
                    @else poin-berat @endif">
                    {{ $p->jenisPelanggaran->poin ?? 0 }}
                </td>
                <td class="text-center">{{ ucfirst($p->status) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data pelanggaran</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 30px;">
        <p><strong>Total Pelanggaran: {{ $pelanggaran->count() }}</strong></p>
        <p>Ringan (1-5 poin): {{ $pelanggaran->filter(fn($p) => $p->jenisPelanggaran && $p->jenisPelanggaran->poin <= 5)->count() }}</p>
        <p>Sedang (6-15 poin): {{ $pelanggaran->filter(fn($p) => $p->jenisPelanggaran && $p->jenisPelanggaran->poin > 5 && $p->jenisPelanggaran->poin <= 15)->count() }}</p>
        <p>Berat (16+ poin): {{ $pelanggaran->filter(fn($p) => $p->jenisPelanggaran && $p->jenisPelanggaran->poin > 15)->count() }}</p>
    </div>
</body>
</html>