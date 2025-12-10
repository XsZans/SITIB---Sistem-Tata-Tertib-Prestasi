<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;

class UpdateSiswaSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = Siswa::all();
        
        $tempatLahir = [
            'Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Semarang',
            'Medan', 'Malang', 'Solo', 'Denpasar', 'Palembang'
        ];
        
        foreach ($siswa as $s) {
            // Tentukan jenis kelamin berdasarkan nama
            $namaLower = strtolower($s->nama);
            $jenisKelamin = 'L'; // default laki-laki
            
            // Cek nama perempuan
            $namaPerempuan = ['siti', 'dewi', 'rina', 'lestari', 'maya', 'nurul', 'putri', 'ratna', 'sri', 'tuti', 'umi', 'vina', 'wulan', 'yuni', 'zaskia', 'ani', 'indah', 'fitri', 'dian', 'rini'];
            foreach ($namaPerempuan as $cekNama) {
                if (strpos($namaLower, $cekNama) !== false) {
                    $jenisKelamin = 'P';
                    break;
                }
            }
            
            // Generate tanggal lahir random (umur 15-18 tahun)
            $tahunLahir = rand(2006, 2009);
            $bulanLahir = rand(1, 12);
            $hariLahir = rand(1, 28);
            $tanggalLahir = sprintf('%04d-%02d-%02d', $tahunLahir, $bulanLahir, $hariLahir);
            
            $s->update([
                'jenis_kelamin' => $jenisKelamin,
                'tempat_lahir' => $tempatLahir[array_rand($tempatLahir)],
                'tanggal_lahir' => $tanggalLahir
            ]);
        }
    }
}