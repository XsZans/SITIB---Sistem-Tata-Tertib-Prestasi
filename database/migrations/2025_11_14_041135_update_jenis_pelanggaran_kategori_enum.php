<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jenis_pelanggaran', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
        
        Schema::table('jenis_pelanggaran', function (Blueprint $table) {
            $table->enum('kategori', ['I', 'II', 'III'])->after('poin');
        });
    }

    public function down(): void
    {
        Schema::table('jenis_pelanggaran', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
        
        Schema::table('jenis_pelanggaran', function (Blueprint $table) {
            $table->enum('kategori', ['ringan', 'sedang', 'berat'])->after('poin');
        });
    }
};