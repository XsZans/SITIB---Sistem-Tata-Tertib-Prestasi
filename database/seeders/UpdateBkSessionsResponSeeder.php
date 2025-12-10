<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BkSession;

class UpdateBkSessionsResponSeeder extends Seeder
{
    public function run(): void
    {
        // Update semua BK sessions yang belum memiliki respon_siswa
        BkSession::whereNull('respon_siswa')
            ->orWhere('respon_siswa', '')
            ->update(['respon_siswa' => 'menunggu']);
        
        $this->command->info('BK Sessions berhasil diupdate.');
    }
}
