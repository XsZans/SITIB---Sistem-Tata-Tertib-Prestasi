<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaBaruSeeder extends Seeder
{
    public function run(): void
    {
        $jurusan = [
            'Pemasaran',
            'Animasi', 
            'Desain Komunikasi Visual',
            'Pengembangan Perangkat Lunak dan Gim',
            'Akuntansi'
        ];
        
        $tingkat = [10, 11, 12];
        $kelas = [1, 2];
        
        $siswaData = [];
        $counter = 1;
        
        foreach ($jurusan as $jur) {
            foreach ($tingkat as $tkt) {
                foreach ($kelas as $kls) {
                    $singkatan = $this->getSingkatan($jur);
                    $namaKelas = $singkatan . $kls;
                    
                    // Generate 5 siswa per kelas
                    for ($i = 1; $i <= 5; $i++) {
                        $siswaData[] = [
                            'nis' => '2024' . str_pad($counter, 3, '0', STR_PAD_LEFT) . '93',
                            'nama' => $this->generateNama(),
                            'kelas' => $tkt . ' ' . $namaKelas,
                            'jurusan' => $jur,
                            'poin_pelanggaran' => rand(0, 50),
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
    
    private function getSingkatan($jurusan): string
    {
        $singkatan = [
            'Pemasaran' => 'PMS',
            'Animasi' => 'ANM',
            'Desain Komunikasi Visual' => 'DKV',
            'Pengembangan Perangkat Lunak dan Gim' => 'PPLG',
            'Akuntansi' => 'AKT'
        ];
        
        return $singkatan[$jurusan];
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