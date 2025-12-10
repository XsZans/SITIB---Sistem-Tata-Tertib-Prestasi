<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bk_sessions', function (Blueprint $table) {
            $table->enum('respon_siswa', ['menunggu', 'diterima', 'ditolak'])->default('menunggu')->after('status');
            $table->text('alasan_siswa')->nullable()->after('respon_siswa');
        });
    }

    public function down(): void
    {
        Schema::table('bk_sessions', function (Blueprint $table) {
            $table->dropColumn(['respon_siswa', 'alasan_siswa']);
        });
    }
};
