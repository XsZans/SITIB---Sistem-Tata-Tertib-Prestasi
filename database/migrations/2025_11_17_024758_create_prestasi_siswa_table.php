<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('prestasi_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('prestasi_id')->constrained('prestasi')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('pengadu_id')->constrained('users')->onDelete('cascade');
            $table->datetime('tanggal_prestasi');
            $table->text('keterangan')->nullable();
            $table->string('bukti_gambar')->nullable();
            $table->enum('status', ['menunggu_verifikasi', 'diverifikasi', 'ditolak'])->default('menunggu_verifikasi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prestasi_siswa');
    }
};