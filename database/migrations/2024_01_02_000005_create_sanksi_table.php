<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sanksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggaran_id')->constrained('pelanggaran')->onDelete('cascade');
            $table->string('jenis_sanksi');
            $table->text('deskripsi_sanksi');
            $table->date('tanggal_sanksi');
            $table->enum('status_sanksi', ['belum_dilaksanakan', 'sedang_dilaksanakan', 'selesai'])->default('belum_dilaksanakan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sanksi');
    }
};