<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);
        
        User::create([
            'name' => 'Kesiswaan',
            'username' => 'kesiswaan',
            'email' => 'kesiswaan@smkbn666.sch.id',
            'role' => 'kesiswaan',
            'password' => Hash::make('kesiswaan123'),
        ]);
    }
}