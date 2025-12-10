<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class FixSpecificRoles extends Command
{
    protected $signature = 'fix:specific-roles';
    protected $description = 'Fix specific user roles';

    public function handle()
    {
        // Fix kesiswaan user
        $kesiswaan = User::where('username', 'kesiswaan')->first();
        if ($kesiswaan) {
            $kesiswaan->update(['role' => 'kesiswaan']);
            $this->line("Fixed: kesiswaan -> kesiswaan");
        }
        
        // Fix kepala sekolah user
        $kepsek = User::where('username', 'kepsek')->first();
        if ($kepsek) {
            $kepsek->update(['role' => 'kepala_sekolah']);
            $this->line("Fixed: kepsek -> kepala_sekolah");
        }
        
        // Fix orang tua users (yang role masih admin)
        $orangTuaUsers = User::where('role', 'admin')
            ->where('username', 'like', 'Or%')
            ->get();
        
        foreach ($orangTuaUsers as $user) {
            $user->update(['role' => 'orang_tua']);
            $this->line("Fixed: {$user->username} -> orang_tua");
        }
        
        $this->info('Specific roles fixed!');
    }
}