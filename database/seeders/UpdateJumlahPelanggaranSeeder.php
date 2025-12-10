<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Pelanggaran;

class UpdateJumlahPelanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswaList = Siswa::all();
        
        foreach ($siswaList as $siswa) {
            $jumlahPelanggaran = Pelanggaran::where('siswa_id', $siswa->id)
                ->whereIn('status', ['diverifikasi', 'menunggu_verifikasi'])
                ->count();
                
            $siswa->update(['jumlah_pelanggaran' => $jumlahPelanggaran]);
        }
        
        $this->command->info('Jumlah pelanggaran siswa berhasil diupdate.');
    }
}