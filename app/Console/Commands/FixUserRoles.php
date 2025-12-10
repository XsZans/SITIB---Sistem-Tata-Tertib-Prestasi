<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;

class FixUserRoles extends Command
{
    protected $signature = 'fix:user-roles';
    protected $description = 'Fix user roles based on their data';

    public function handle()
    {
        $this->info('Fixing user roles...');
        
        // Fix siswa roles
        $siswaUsers = Siswa::with('user')->whereNotNull('user_id')->get();
        foreach ($siswaUsers as $siswa) {
            if ($siswa->user && $siswa->user->role !== 'siswa') {
                $siswa->user->update(['role' => 'siswa']);
                $this->line("Fixed: {$siswa->nama} -> siswa");
            }
        }
        
        // Fix guru roles
        $guruUsers = Guru::with('user')->whereNotNull('user_id')->get();
        foreach ($guruUsers as $guru) {
            if ($guru->user) {
                $correctRole = 'guru';
                if ($guru->jabatan === 'guru_bk') {
                    $correctRole = 'bk';
                } elseif ($guru->jabatan === 'kesiswaan') {
                    $correctRole = 'kesiswaan';
                } elseif ($guru->jabatan === 'kepala_sekolah') {
                    $correctRole = 'kepala_sekolah';
                } elseif ($guru->wali_kelas) {
                    $correctRole = 'wali_kelas';
                }
                
                if ($guru->user->role !== $correctRole) {
                    $guru->user->update(['role' => $correctRole]);
                    $this->line("Fixed: {$guru->nama} -> {$correctRole}");
                }
            }
        }
        
        // Keep admin role for actual admin
        $adminUser = User::where('username', 'admin')->first();
        if ($adminUser && $adminUser->role !== 'admin') {
            $adminUser->update(['role' => 'admin']);
            $this->line("Fixed: Admin -> admin");
        }
        
        $this->info('User roles fixed!');
    }
}