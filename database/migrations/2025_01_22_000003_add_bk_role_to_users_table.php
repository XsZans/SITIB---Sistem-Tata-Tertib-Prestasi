<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Update enum untuk menambahkan role 'bk'
            $table->dropColumn('role');
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'kesiswaan', 'kepala_sekolah', 'wali_kelas', 'guru', 'siswa', 'orang_tua', 'bk'])->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'kesiswaan', 'kepala_sekolah', 'wali_kelas', 'guru', 'siswa', 'orang_tua'])->after('password');
        });
    }
};