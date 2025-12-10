<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\JenisPelanggaran;

return new class extends Migration
{
    public function up(): void
    {
        // Add the dropout violation
        JenisPelanggaran::create([
            'nama_pelanggaran' => 'Dikembalikan kepada orang tua (Drop Out)',
            'deskripsi' => 'Siswa dengan total poin pelanggaran 90-100 dikembalikan kepada orang tua dan dikeluarkan dari sekolah',
            'poin' => 100,
            'kategori' => 'I'
        ]);
    }

    public function down(): void
    {
        JenisPelanggaran::where('nama_pelanggaran', 'Dikembalikan kepada orang tua (Drop Out)')->delete();
    }
};