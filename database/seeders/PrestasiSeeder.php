<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prestasi;

class PrestasiSeeder extends Seeder
{
    public function run()
    {
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
    }
}