<?php
// Script untuk mengecek dan update role di MySQL

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

try {
    // Cek struktur tabel users
    echo "=== Checking MySQL Users Table Structure ===\n";
    $columns = DB::select("DESCRIBE users");
    
    foreach ($columns as $column) {
        if ($column->Field === 'role') {
            echo "✓ Role column found: {$column->Type}\n";
            
            // Cek apakah sudah ada role baru
            if (strpos($column->Type, 'kepala_sekolah') !== false) {
                echo "✓ New roles already exist in database\n";
            } else {
                echo "⚠ Need to update role enum\n";
                
                // Update role enum
                DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'guru_bk', 'wali_kelas', 'guru', 'orang_tua', 'siswa', 'kepala_sekolah')");
                echo "✓ Role enum updated successfully\n";
            }
        }
    }
    
    // Cek existing users
    echo "\n=== Current Users in Database ===\n";
    $users = DB::table('users')->select('username', 'role', 'name')->get();
    
    foreach ($users as $user) {
        echo "- {$user->username} ({$user->role}): {$user->name}\n";
    }
    
    // Add missing users if needed
    echo "\n=== Adding Missing Users ===\n";
    
    $newUsers = [
        ['username' => 'kepsek', 'name' => 'Kepala Sekolah', 'email' => 'kepsek@sitib.com', 'role' => 'kepala_sekolah'],
        ['username' => 'ortu', 'name' => 'Orang Tua Siswa', 'email' => 'ortu@sitib.com', 'role' => 'orang_tua'],
        ['username' => 'siswa001', 'name' => 'Ahmad Rizki Pratama', 'email' => 'siswa001@sitib.com', 'role' => 'siswa'],
    ];
    
    foreach ($newUsers as $userData) {
        $exists = DB::table('users')->where('username', $userData['username'])->exists();
        
        if (!$exists) {
            DB::table('users')->insert([
                'name' => $userData['name'],
                'username' => $userData['username'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['username'] . '123'),
                'role' => $userData['role'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            echo "✓ Added user: {$userData['username']}\n";
        } else {
            echo "- User already exists: {$userData['username']}\n";
        }
    }
    
    echo "\n=== Final User List ===\n";
    $finalUsers = DB::table('users')->select('username', 'role', 'name')->get();
    
    foreach ($finalUsers as $user) {
        echo "- {$user->username} ({$user->role}): {$user->name}\n";
    }
    
    echo "\n✓ MySQL roles check and update completed!\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
?>