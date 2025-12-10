<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear all data from sanksi table first (child table)
        DB::table('sanksi')->truncate();
        
        // Clear all data from pelanggaran table
        DB::table('pelanggaran')->truncate();
        
        // Clear all data from prestasi_siswa table
        DB::table('prestasi_siswa')->truncate();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cannot reverse truncate operation
        // Data will be permanently lost
    }
};