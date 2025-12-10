<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class UpdateSiswaKelasFormatSeeder extends Seeder
{
    public function run(): void
    {
        $siswaList = Siswa::all();
        
        foreach ($siswaList as $siswa) {
            $kelas = $siswa->kelas;
            
            // Jika format masih angka (10 PPLG1, 11 PPLG1, 12 PPLG1)
            if (preg_match('/^(\d+)\s+([A-Z]+)(\d+)$/', $kelas, $matches)) {
                $tingkat = $matches[1];
                $jurusan = $matches[2];
                $nomor = $matches[3];
                
                // Konversi ke romawi
                $tingkatRomawi = match($tingkat) {
                    '10' => 'X',
                    '11' => 'XI',
                    '12' => 'XII',
                    default => $tingkat
                };
                
                // Format baru: XII PPLG 1
                $kelasBaru = $tingkatRomawi . ' ' . $jurusan . ' ' . $nomor;
                
                $siswa->update(['kelas' => $kelasBaru]);
                
                echo "Updated: {$kelas} -> {$kelasBaru}\n";
            }
        }
        
        echo "Selesai mengupdate format kelas siswa\n";
    }
}