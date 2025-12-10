<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggaran;
use App\Models\User;

class UpdatePelanggaranPengaduSeeder extends Seeder
{
    public function run()
    {
        // Update existing pelanggaran records to have pengadu_id same as user_id
        $pelanggaran = Pelanggaran::whereNull('pengadu_id')->get();
        
        foreach ($pelanggaran as $p) {
            $p->pengadu_id = $p->user_id;
            $p->save();
        }
        
        $this->command->info('Updated ' . $pelanggaran->count() . ' pelanggaran records with pengadu_id');
    }
}