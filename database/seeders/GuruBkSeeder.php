<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;

class GuruBkSeeder extends Seeder
{
    public function run(): void
    {
        // Tambah guru BK jika belum ada
        $guruBk = Guru::where('jabatan', 'guru_bk')->first();
        
        if (!$guruBk) {
            Guru::create([
                'nama' => 'Dra. Siti Nurhaliza, M.Pd',
                'nip' => '196505151990032001',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1965-05-15',
                'mata_pelajaran' => 'Bimbingan Konseling',
                'jabatan' => 'guru_bk',
                'tanggal_masuk_kerja' => '1990-03-01'
            ]);
        }
        
        // Tambah guru BK kedua jika diperlukan
        $guruBk2 = Guru::where('nama', 'Drs. Ahmad Fauzi, S.Pd')->first();
        
        if (!$guruBk2) {
            Guru::create([
                'nama' => 'Drs. Ahmad Fauzi, S.Pd',
                'nip' => '197203101995121001',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1972-03-10',
                'mata_pelajaran' => 'Bimbingan Konseling',
                'jabatan' => 'guru_bk',
                'tanggal_masuk_kerja' => '1995-12-01'
            ]);
        }
    }
}