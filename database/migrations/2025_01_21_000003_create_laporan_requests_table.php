<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laporan_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('periode');
            $table->integer('bulan')->nullable();
            $table->integer('tahun');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('verifikator_id')->nullable()->constrained('users')->onDelete('set null');
            $table->text('alasan_tolak')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_requests');
    }
};