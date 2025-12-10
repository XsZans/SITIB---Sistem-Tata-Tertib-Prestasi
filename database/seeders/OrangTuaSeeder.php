<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\OrangTua;

class OrangTuaSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = Siswa::all();
        
        $namaWali = [
            'Ahmad Wijaya', 'Siti Nurhaliza', 'Budi Santoso', 'Dewi Sartika', 'Candra Kusuma',
            'Rina Melati', 'Dedi Prasetyo', 'Lestari Indah', 'Eko Susanto', 'Maya Sari',
            'Fajar Nugroho', 'Nurul Hidayah', 'Gunawan Hidayat', 'Putri Ayu', 'Hendra Setiawan'
        ];
        
        $pekerjaan = [
            'Pegawai Negeri Sipil', 'Wiraswasta', 'Guru', 'Petani', 'Pedagang',
            'Buruh', 'Supir', 'Tukang', 'Ibu Rumah Tangga', 'Karyawan Swasta',
            'Dokter', 'Perawat', 'Polisi', 'TNI', 'Pensiunan'
        ];
        
        $alamat = [
            'Jl. Merdeka No. 123, Jakarta Pusat',
            'Jl. Sudirman No. 456, Bandung',
            'Jl. Diponegoro No. 789, Surabaya',
            'Jl. Ahmad Yani No. 321, Yogyakarta',
            'Jl. Gatot Subroto No. 654, Semarang',
            'Jl. Pahlawan No. 987, Medan',
            'Jl. Veteran No. 147, Malang',
            'Jl. Pemuda No. 258, Solo',
            'Jl. Kartini No. 369, Denpasar',
            'Jl. Cut Nyak Dien No. 741, Palembang'
        ];
        
        $namaAyah = [
            'Ahmad Wijaya', 'Budi Santoso', 'Candra Kusuma', 'Dedi Prasetyo', 'Eko Susanto',
            'Fajar Nugroho', 'Gunawan Hidayat', 'Hendra Setiawan', 'Indra Permana', 'Joko Widodo',
            'Kurnia Rahman', 'Lukman Hakim', 'Mulyadi Sari', 'Nanda Pratama', 'Oscar Ramadhan'
        ];
        
        $namaIbu = [
            'Siti Nurhaliza', 'Dewi Sartika', 'Rina Melati', 'Lestari Indah', 'Maya Sari',
            'Nurul Hidayah', 'Putri Ayu', 'Ratna Dewi', 'Sri Wahyuni', 'Tuti Handayani',
            'Umi Kalsum', 'Vina Panduwinata', 'Wulan Guritno', 'Yuni Shara', 'Zaskia Adya'
        ];
        
        foreach ($siswa as $s) {
            $alamatOrtu = $alamat[array_rand($alamat)];
            
            // Update alamat siswa sama dengan orang tua
            $s->update(['alamat' => $alamatOrtu]);
            
            OrangTua::create([
                'siswa_id' => $s->id,
                'nama_ayah' => $namaAyah[array_rand($namaAyah)],
                'nama_ibu' => $namaIbu[array_rand($namaIbu)],
                'no_hp' => '08' . rand(1000000000, 9999999999),
                'alamat' => $alamatOrtu,
                'pekerjaan_ayah' => $pekerjaan[array_rand($pekerjaan)],
                'pekerjaan_ibu' => $pekerjaan[array_rand($pekerjaan)],
            ]);
        }
    }
}