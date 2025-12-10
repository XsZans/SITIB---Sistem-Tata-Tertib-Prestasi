<?php
// Script untuk mengecek database dan menambah data siswa jika kosong

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Siswa;
use Illuminate\Support\Facades\DB;

try {
    // Cek koneksi database
    DB::connection()->getPdo();
    echo "✓ Database connection: OK\n";
    
    // Cek tabel siswa
    $siswaCount = Siswa::count();
    echo "✓ Jumlah siswa di database: $siswaCount\n";
    
    if ($siswaCount == 0) {
        echo "⚠ Database siswa kosong, menambahkan data...\n";
        
        $siswaData = [
            ['nis' => '2024001', 'nama' => 'Ahmad Rizki Pratama', 'kelas' => 'XII RPL 1', 'jurusan' => 'Rekayasa Perangkat Lunak', 'poin_pelanggaran' => 0],
            ['nis' => '2024002', 'nama' => 'Siti Nurhaliza', 'kelas' => 'XII RPL 1', 'jurusan' => 'Rekayasa Perangkat Lunak', 'poin_pelanggaran' => 0],
            ['nis' => '2024003', 'nama' => 'Budi Santoso', 'kelas' => 'XII TKJ 1', 'jurusan' => 'Teknik Komputer Jaringan', 'poin_pelanggaran' => 0],
            ['nis' => '2024004', 'nama' => 'Dewi Sartika', 'kelas' => 'XII TKJ 1', 'jurusan' => 'Teknik Komputer Jaringan', 'poin_pelanggaran' => 0],
            ['nis' => '2024005', 'nama' => 'Eko Prasetyo', 'kelas' => 'XII MM 1', 'jurusan' => 'Multimedia', 'poin_pelanggaran' => 0],
            ['nis' => '2024006', 'nama' => 'Fitri Handayani', 'kelas' => 'XII MM 1', 'jurusan' => 'Multimedia', 'poin_pelanggaran' => 0],
            ['nis' => '2024007', 'nama' => 'Gilang Ramadhan', 'kelas' => 'XI RPL 1', 'jurusan' => 'Rekayasa Perangkat Lunak', 'poin_pelanggaran' => 0],
            ['nis' => '2024008', 'nama' => 'Hani Safitri', 'kelas' => 'XI RPL 1', 'jurusan' => 'Rekayasa Perangkat Lunak', 'poin_pelanggaran' => 0],
            ['nis' => '2024009', 'nama' => 'Indra Gunawan', 'kelas' => 'XI TKJ 1', 'jurusan' => 'Teknik Komputer Jaringan', 'poin_pelanggaran' => 0],
            ['nis' => '2024010', 'nama' => 'Jihan Aulia', 'kelas' => 'XI TKJ 1', 'jurusan' => 'Teknik Komputer Jaringan', 'poin_pelanggaran' => 0],
        ];
        
        foreach ($siswaData as $data) {
            Siswa::create($data);
        }
        
        echo "✓ Data siswa berhasil ditambahkan!\n";
    } else {
        echo "✓ Data siswa sudah ada\n";
        
        // Tampilkan beberapa data siswa
        $siswa = Siswa::take(3)->get();
        foreach ($siswa as $s) {
            echo "- {$s->nis}: {$s->nama} - {$s->kelas} - {$s->jurusan}\n";
        }
    }
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "Pastikan database sudah dibuat dan migration sudah dijalankan\n";
}
?>