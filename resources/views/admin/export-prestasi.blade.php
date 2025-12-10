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
        .akademik { background-color: #dcfce7; }
        .non-akademik { background-color: #dbeafe; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">{{ $title }}</div>
        <div>SMK Bakti Nusantara 666</div>
        <div>Tanggal Cetak: {{ now()->format('d/m/Y H:i:s') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Nama Siswa</th>
                <th width="15%">NIS</th>
                <th width="15%">Kelas</th>
                <th width="20%">Jenis Prestasi</th>
                <th width="10%">Kategori</th>
                <th width="10%">Poin</th>
                <th width="15%">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prestasi as $index => $item)
                <tr class="{{ $item->prestasi->kategori == 'akademik' ? 'akademik' : 'non-akademik' }}">
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->siswa->nama }}</td>
                    <td>{{ $item->siswa->nis }}</td>
                    <td>{{ $item->siswa->kelas }}</td>
                    <td>{{ $item->prestasi->nama }}</td>
                    <td class="text-center">{{ ucfirst($item->prestasi->kategori) }}</td>
                    <td class="text-center">{{ $item->prestasi->poin_pengurangan }}</td>
                    <td class="text-center">{{ $item->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data prestasi</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($prestasi->count() > 0)
        <div style="margin-top: 20px;">
            <strong>Ringkasan:</strong><br>
            Total Prestasi: {{ $prestasi->count() }}<br>
            Prestasi Akademik: {{ $prestasi->where('prestasi.kategori', 'akademik')->count() }}<br>
            Prestasi Non-Akademik: {{ $prestasi->where('prestasi.kategori', 'non-akademik')->count() }}
        </div>
    @endif
</body>
</html>