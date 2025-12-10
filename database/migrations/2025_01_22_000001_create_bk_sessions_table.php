<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bk_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('guru_bk_id')->constrained('guru')->onDelete('cascade');
            $table->enum('jenis', ['pengajuan_siswa', 'panggilan_bk']);
            $table->text('alasan');
            $table->text('catatan_bk')->nullable();
            $table->enum('status', ['pending', 'dijadwalkan', 'selesai', 'dibatalkan'])->default('pending');
            $table->datetime('jadwal_bk')->nullable();
            $table->text('hasil_bk')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bk_sessions');
    }
};