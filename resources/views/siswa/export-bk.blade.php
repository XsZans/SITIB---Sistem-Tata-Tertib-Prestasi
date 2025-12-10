<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Bimbingan Konseling - {{ $siswa->nama }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2 { margin: 5px 0; }
        .info { margin-bottom: 20px; }
        .info table { width: 100%; }
        .info td { padding: 3px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; font-weight: bold; }
        .footer { margin-top: 30px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN BIMBINGAN KONSELING</h2>
        <h3>SMK Bakti Nusantara 666</h3>
        <p>Jl. Percobaan KM. 17 No. 65, Cimekar, Kec. Cileunyi, Kab. Bandung</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td width="150"><strong>Nama Siswa</strong></td>
                <td>: {{ $siswa->nama }}</td>
            </tr>
            <tr>
                <td><strong>NIS</strong></td>
                <td>: {{ $siswa->nis }}</td>
            </tr>
            <tr>
                <td><strong>Kelas</strong></td>
                <td>: {{ $siswa->kelas }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Cetak</strong></td>
                <td>: {{ date('d/m/Y H:i') }}</td>
            </tr>
        </table>
    </div>

    <h3>Riwayat Bimbingan Konseling</h3>
    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Tanggal</th>
                <th>Guru BK</th>
                <th>Jenis</th>
                <th>Tujuan</th>
                <th>Alasan</th>
                <th>Status</th>
                <th>Hasil</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bkSessions as $index => $session)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $session->jadwal_bk ? \Carbon\Carbon::parse($session->jadwal_bk)->format('d/m/Y H:i') : '-' }}</td>
                <td>{{ $session->guruBk->nama }}</td>
                <td style="{{ $session->jenis == 'pengajuan_siswa' ? 'background-color: #dbeafe; font-weight: bold;' : 'background-color: #fef3c7; font-weight: bold;' }}">
                    {{ $session->jenis == 'panggilan_bk' ? 'Panggilan BK' : 'Permintaan Siswa' }}
                </td>
                <td>{{ $session->tujuan_bimbingan ?? '-' }}</td>
                <td>{{ $session->alasan }}</td>
                <td>
                    @if($session->status == 'pending') Menunggu
                    @elseif($session->status == 'dijadwalkan') Dijadwalkan
                    @elseif($session->status == 'selesai') Selesai
                    @else Dibatalkan
                    @endif
                </td>
                <td>{{ $session->hasil_bk ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center;">Tidak ada riwayat bimbingan konseling</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Bandung, {{ date('d F Y') }}</p>
        <br><br><br>
        <p>_______________________</p>
        <p>Guru BK</p>
    </div>
</body>
</html>
