<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pelanggaran', function (Blueprint $table) {
            $table->unsignedBigInteger('pengadu_id')->nullable()->after('user_id');
            $table->foreign('pengadu_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('pelanggaran', function (Blueprint $table) {
            $table->dropForeign(['pengadu_id']);
            $table->dropColumn('pengadu_id');
        });
    }
};