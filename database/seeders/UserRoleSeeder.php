<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'Admin System', 'username' => 'admin2', 'email' => 'admin2@sitib.com', 'role' => 'admin'],
            ['name' => 'Staff Kesiswaan', 'username' => 'kesiswaan2', 'email' => 'kesiswaan2@sitib.com', 'role' => 'kesiswaan'],
            ['name' => 'Guru Pengajar', 'username' => 'guru2', 'email' => 'guru2@sitib.com', 'role' => 'guru'],
            ['name' => 'Wali Kelas', 'username' => 'walikelas2', 'email' => 'walikelas2@sitib.com', 'role' => 'wali_kelas'],
            ['name' => 'Kepala Sekolah', 'username' => 'kepsek2', 'email' => 'kepsek2@sitib.com', 'role' => 'kepala_sekolah'],
            ['name' => 'Guru BK', 'username' => 'bk2', 'email' => 'bk2@sitib.com', 'role' => 'guru_bk'],
        ];

        foreach ($roles as $roleData) {
            User::firstOrCreate(
                ['username' => $roleData['username']],
                [
                    'name' => $roleData['name'],
                    'email' => $roleData['email'],
                    'password' => Hash::make('password123'),
                    'role' => $roleData['role'],
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}