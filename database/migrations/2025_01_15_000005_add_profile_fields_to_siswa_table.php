<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->after('nama');
            $table->date('tanggal_lahir')->nullable()->after('jenis_kelamin');
            $table->string('tempat_lahir')->nullable()->after('tanggal_lahir');
            $table->string('alamat')->nullable()->after('tempat_lahir');
            $table->string('no_telepon')->nullable()->after('alamat');
        });
    }

    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn(['jenis_kelamin', 'tanggal_lahir', 'tempat_lahir', 'alamat', 'no_telepon']);
        });
    }
};