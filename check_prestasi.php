<?php
// Script untuk mengecek data prestasi di database

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Prestasi;
use Illuminate\Support\Facades\DB;

try {
    // Cek koneksi database
    DB::connection()->getPdo();
    echo "✓ Database connection: OK\n";
    
    // Cek tabel prestasi
    $prestasiCount = Prestasi::count();
    echo "✓ Jumlah prestasi di database: $prestasiCount\n";
    
    if ($prestasiCount == 0) {
        echo "⚠ Database prestasi kosong, menjalankan seeder...\n";
        
        // Jalankan seeder prestasi
        $prestasi = [
            // Akademik
            ['nama' => 'Juara 1 Kompetisi Akademik', 'kategori' => 'akademik', 'tingkat' => 'daerah', 'poin_pengurangan' => 30],
            ['nama' => 'Juara 2 Kompetisi Akademik', 'kategori' => 'akademik', 'tingkat' => 'daerah', 'poin_pengurangan' => 25],
            ['nama' => 'Juara 3 Kompetisi Akademik', 'kategori' => 'akademik', 'tingkat' => 'daerah', 'poin_pengurangan' => 20],
            ['nama' => 'Juara Harapan Kompetisi Akademik', 'kategori' => 'akademik', 'tingkat' => 'daerah', 'poin_pengurangan' => 15],
            
            ['nama' => 'Juara 1 Kompetisi Akademik', 'kategori' => 'akademik', 'tingkat' => 'nasional', 'poin_pengurangan' => 40],
            ['nama' => 'Juara 2 Kompetisi Akademik', 'kategori' => 'akademik', 'tingkat' => 'nasional', 'poin_pengurangan' => 35],
            ['nama' => 'Juara 3 Kompetisi Akademik', 'kategori' => 'akademik', 'tingkat' => 'nasional', 'poin_pengurangan' => 30],
            ['nama' => 'Juara Harapan Kompetisi Akademik', 'kategori' => 'akademik', 'tingkat' => 'nasional', 'poin_pengurangan' => 25],
            
            ['nama' => 'Juara 1 Kompetisi Akademik', 'kategori' => 'akademik', 'tingkat' => 'internasional', 'poin_pengurangan' => 50],
            ['nama' => 'Juara 2 Kompetisi Akademik', 'kategori' => 'akademik', 'tingkat' => 'internasional', 'poin_pengurangan' => 45],
            ['nama' => 'Juara 3 Kompetisi Akademik', 'kategori' => 'akademik', 'tingkat' => 'internasional', 'poin_pengurangan' => 40],
            
            // Non-Akademik
            ['nama' => 'Juara 1 Kompetisi Non-Akademik', 'kategori' => 'non-akademik', 'tingkat' => 'daerah', 'poin_pengurangan' => 20],
            ['nama' => 'Juara 2 Kompetisi Non-Akademik', 'kategori' => 'non-akademik', 'tingkat' => 'daerah', 'poin_pengurangan' => 15],
            ['nama' => 'Juara 3 Kompetisi Non-Akademik', 'kategori' => 'non-akademik', 'tingkat' => 'daerah', 'poin_pengurangan' => 10],
            ['nama' => 'Juara Harapan Kompetisi Non-Akademik', 'kategori' => 'non-akademik', 'tingkat' => 'daerah', 'poin_pengurangan' => 5],
            
            ['nama' => 'Juara 1 Kompetisi Non-Akademik', 'kategori' => 'non-akademik', 'tingkat' => 'nasional', 'poin_pengurangan' => 30],
            ['nama' => 'Juara 2 Kompetisi Non-Akademik', 'kategori' => 'non-akademik', 'tingkat' => 'nasional', 'poin_pengurangan' => 25],
            ['nama' => 'Juara 3 Kompetisi Non-Akademik', 'kategori' => 'non-akademik', 'tingkat' => 'nasional', 'poin_pengurangan' => 20],
            ['nama' => 'Juara Harapan Kompetisi Non-Akademik', 'kategori' => 'non-akademik', 'tingkat' => 'nasional', 'poin_pengurangan' => 15],
            
            ['nama' => 'Juara 1 Kompetisi Non-Akademik', 'kategori' => 'non-akademik', 'tingkat' => 'internasional', 'poin_pengurangan' => 40],
            ['nama' => 'Juara 2 Kompetisi Non-Akademik', 'kategori' => 'non-akademik', 'tingkat' => 'internasional', 'poin_pengurangan' => 35],
            ['nama' => 'Juara 3 Kompetisi Non-Akademik', 'kategori' => 'non-akademik', 'tingkat' => 'internasional', 'poin_pengurangan' => 30],
        ];

        foreach ($prestasi as $item) {
            Prestasi::create($item);
        }
        
        echo "✓ Data prestasi berhasil ditambahkan!\n";
    } else {
        echo "✓ Data prestasi sudah ada\n";
        
        // Tampilkan beberapa data prestasi
        $prestasiList = Prestasi::take(5)->get();
        foreach ($prestasiList as $p) {
            echo "- {$p->nama} ({$p->kategori}) - {$p->tingkat} - {$p->poin_pengurangan} poin\n";
        }
    }
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "Pastikan database sudah dibuat dan migration sudah dijalankan\n";
}
?>