<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('backup_history', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->enum('type', ['manual', 'automatic']);
            $table->bigInteger('file_size');
            $table->string('created_by')->nullable();
            $table->timestamp('created_at');
            $table->index('type');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('backup_history');
    }
};