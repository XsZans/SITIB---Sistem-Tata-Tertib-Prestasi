<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaLengkapSeeder extends Seeder
{
    public function run(): void
    {
        $jurusan = [
            'PMS' => 'Pemasaran',
            'ANM' => 'Animasi', 
            'DKV' => 'Desain Komunikasi Visual',
            'PPLG' => 'Pengembangan Perangkat Lunak dan Gim',
            'AKT' => 'Akuntansi'
        ];
        $tingkat = [10, 11, 12];
        $kelas = [1, 2];
        
        $siswaData = [];
        $counter = 1;
        
        foreach ($jurusan as $jurSingkat => $jurLengkap) {
            foreach ($tingkat as $tkt) {
                foreach ($kelas as $kls) {
                    $namaKelas = $jurSingkat . $kls;
                    
                    // Generate 5 siswa per kelas
                    for ($i = 1; $i <= 5; $i++) {
                        // Konversi tingkat ke romawi
                        $tingkatRomawi = match($tkt) {
                            10 => 'X',
                            11 => 'XI',
                            12 => 'XII',
                            default => $tkt
                        };
                        
                        $siswaData[] = [
                            'nis' => '2024' . str_pad($counter, 3, '0', STR_PAD_LEFT),
                            'nama' => $this->generateNama(),
                            'kelas' => $tingkatRomawi . ' ' . $jurSingkat . ' ' . $kls,
                            'jurusan' => $jurLengkap,
                            'poin_pelanggaran' => 0,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                        $counter++;
                    }
                }
            }
        }
        
        Siswa::insert($siswaData);
    }
    
    private function generateNama(): string
    {
        $namaDepan = [
            'Ahmad', 'Budi', 'Citra', 'Dina', 'Eko', 'Fitri', 'Gilang', 'Hana', 'Indra', 'Joko',
            'Kartika', 'Lina', 'Maya', 'Nanda', 'Oka', 'Putri', 'Qori', 'Rina', 'Sari', 'Toni',
            'Umar', 'Vina', 'Wati', 'Xena', 'Yudi', 'Zara', 'Andi', 'Bella', 'Candra', 'Dewi'
        ];
        
        $namaBelakang = [
            'Pratama', 'Sari', 'Wijaya', 'Putri', 'Santoso', 'Lestari', 'Permana', 'Anggraini',
            'Setiawan', 'Maharani', 'Nugroho', 'Safitri', 'Kurniawan', 'Rahayu', 'Firmansyah',
            'Wulandari', 'Hidayat', 'Kusuma', 'Ramadhan', 'Salsabila', 'Hakim', 'Azzahra'
        ];
        
        return $namaDepan[array_rand($namaDepan)] . ' ' . $namaBelakang[array_rand($namaBelakang)];
    }
}