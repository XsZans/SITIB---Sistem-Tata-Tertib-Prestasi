<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@sitib.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Guru BK',
            'username' => 'guru_bk',
            'email' => 'gurubk@sitib.com',
            'password' => Hash::make('gurubk123'),
            'role' => 'guru_bk',
        ]);

        User::create([
            'name' => 'Wali Kelas XII RPL 1',
            'username' => 'wali_kelas',
            'email' => 'walikelas@sitib.com',
            'password' => Hash::make('walikelas123'),
            'role' => 'wali_kelas',
        ]);

        User::create([
            'name' => 'Guru Mata Pelajaran',
            'username' => 'guru',
            'email' => 'guru@sitib.com',
            'password' => Hash::make('guru123'),
            'role' => 'guru',
        ]);

        User::create([
            'name' => 'Kepala Sekolah',
            'username' => 'kepsek',
            'email' => 'kepsek@sitib.com',
            'password' => Hash::make('kepsek123'),
            'role' => 'kepala_sekolah',
        ]);

        User::create([
            'name' => 'Orang Tua Siswa',
            'username' => 'ortu',
            'email' => 'ortu@sitib.com',
            'password' => Hash::make('ortu123'),
            'role' => 'orang_tua',
        ]);

        User::create([
            'name' => 'Ahmad Rizki Pratama',
            'username' => 'siswa001',
            'email' => 'siswa001@sitib.com',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa',
        ]);

        User::create([
            'name' => 'Staff Kesiswaan',
            'username' => 'kesiswaan',
            'email' => 'kesiswaan@sitib.com',
            'password' => Hash::make('kesiswaan123'),
            'role' => 'kesiswaan',
        ]);
    }
}