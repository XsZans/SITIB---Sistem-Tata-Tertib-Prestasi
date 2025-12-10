<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Siswa;

class DebugLogin extends Command
{
    protected $signature = 'debug:login';
    protected $description = 'Debug login users';

    public function handle()
    {
        $this->info('=== DEBUG LOGIN USERS ===');
        
        $users = User::all();
        
        foreach ($users as $user) {
            $this->line("ID: {$user->id}");
            $this->line("Name: {$user->name}");
            $this->line("Username: {$user->username}");
            $this->line("Role: {$user->role}");
            $this->line("Verified: " . ($user->is_verified ? 'Yes' : 'No'));
            $this->line("---");
        }
        
        $this->info('=== SISWA WITH USER ACCOUNTS ===');
        
        $siswa = Siswa::with('user')->whereNotNull('user_id')->get();
        
        foreach ($siswa as $s) {
            $this->line("Siswa: {$s->nama} ({$s->kelas})");
            $this->line("Username: {$s->user->username}");
            $this->line("Role: {$s->user->role}");
            $this->line("---");
        }
    }
}