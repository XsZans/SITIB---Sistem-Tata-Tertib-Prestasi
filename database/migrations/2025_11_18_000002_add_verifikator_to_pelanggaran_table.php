<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pelanggaran', function (Blueprint $table) {
            $table->unsignedBigInteger('verifikator_id')->nullable()->after('alasan_tolak');
            $table->timestamp('tanggal_verifikasi')->nullable()->after('verifikator_id');
            
            $table->foreign('verifikator_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('pelanggaran', function (Blueprint $table) {
            $table->dropForeign(['verifikator_id']);
            $table->dropColumn(['verifikator_id', 'tanggal_verifikasi']);
        });
    }
};