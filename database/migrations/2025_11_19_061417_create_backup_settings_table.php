<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('backup_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('auto_backup_enabled')->default(false);
            $table->enum('backup_frequency', ['daily', 'weekly', 'monthly'])->default('daily');
            $table->time('backup_time')->default('02:00:00');
            $table->integer('keep_backups')->default(7);
            $table->timestamp('last_backup_at')->nullable();
            $table->timestamps();
        });
        
        // Insert default settings
        DB::table('backup_settings')->insert([
            'auto_backup_enabled' => false,
            'backup_frequency' => 'daily',
            'backup_time' => '02:00:00',
            'keep_backups' => 7,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('backup_settings');
    }
};