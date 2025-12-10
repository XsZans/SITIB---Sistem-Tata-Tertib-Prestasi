<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Guru;

$guru = Guru::all();

foreach($guru as $g) {
    // Tentukan jenis kelamin berdasarkan nama
    $nama = strtolower($g->nama);
    $jenis_kelamin = 'L'; // default laki-laki
    
    $perempuan_keywords = ['siti', 'dewi', 'sri', 'rina', 'ani', 'indah', 'wati', 'ning', 'tuti', 'yanti'];
    foreach($perempuan_keywords as $keyword) {
        if(strpos($nama, $keyword) !== false) {
            $jenis_kelamin = 'P';
            break;
        }
    }
    
    $cities = ['Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Semarang'];
    $city = $cities[$g->id % 5];
    
    $g->update([
        'jenis_kelamin' => $jenis_kelamin,
        'tempat_lahir' => $city,
        'tanggal_lahir' => date('Y-m-d', strtotime('-' . (25 + ($g->id % 35)) . ' years')),
        'no_hp' => '08' . str_pad($g->id, 10, '1234567890', STR_PAD_LEFT),
        'alamat' => 'Jl. Pendidikan No. ' . ($g->id * 10) . ', Kota Cimahi'
    ]);
}

echo "Data guru berhasil diupdate!\n";
?>