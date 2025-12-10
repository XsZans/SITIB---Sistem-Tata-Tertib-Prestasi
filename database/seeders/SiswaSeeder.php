<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = [
            ['nis' => '2024001', 'nama' => 'Ahmad Rizki Pratama', 'kelas' => 'XII RPL 1', 'jurusan' => 'Rekayasa Perangkat Lunak'],
            ['nis' => '2024002', 'nama' => 'Siti Nurhaliza', 'kelas' => 'XII RPL 1', 'jurusan' => 'Rekayasa Perangkat Lunak'],
            ['nis' => '2024003', 'nama' => 'Budi Santoso', 'kelas' => 'XII TKJ 1', 'jurusan' => 'Teknik Komputer Jaringan'],
            ['nis' => '2024004', 'nama' => 'Dewi Sartika', 'kelas' => 'XII TKJ 1', 'jurusan' => 'Teknik Komputer Jaringan'],
            ['nis' => '2024005', 'nama' => 'Eko Prasetyo', 'kelas' => 'XII MM 1', 'jurusan' => 'Multimedia'],
            ['nis' => '2024006', 'nama' => 'Fitri Handayani', 'kelas' => 'XII MM 1', 'jurusan' => 'Multimedia'],
            ['nis' => '2024007', 'nama' => 'Gilang Ramadhan', 'kelas' => 'XI RPL 1', 'jurusan' => 'Rekayasa Perangkat Lunak'],
            ['nis' => '2024008', 'nama' => 'Hani Safitri', 'kelas' => 'XI RPL 1', 'jurusan' => 'Rekayasa Perangkat Lunak'],
            ['nis' => '2024009', 'nama' => 'Indra Gunawan', 'kelas' => 'XI TKJ 1', 'jurusan' => 'Teknik Komputer Jaringan'],
            ['nis' => '2024010', 'nama' => 'Jihan Aulia', 'kelas' => 'XI TKJ 1', 'jurusan' => 'Teknik Komputer Jaringan'],
        ];

        foreach ($siswa as $data) {
            DB::table('siswa')->insert([
                'nis' => $data['nis'],
                'nama' => $data['nama'],
                'kelas' => $data['kelas'],
                'jurusan' => $data['jurusan'],
                'poin_pelanggaran' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}