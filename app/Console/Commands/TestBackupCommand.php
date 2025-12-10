<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BackupSetting;

class TestBackupCommand extends Command
{
    protected $signature = 'backup:test';
    protected $description = 'Test backup functionality immediately';

    public function handle()
    {
        $this->info('Testing backup functionality...');
        
        $settings = BackupSetting::getSettings();
        $now = \Carbon\Carbon::now('Asia/Jakarta');
        
        $this->info("Current time: {$now->format('Y-m-d H:i:s')} (Asia/Jakarta)");
        $this->info("Backup enabled: " . ($settings->auto_backup_enabled ? 'Yes' : 'No'));
        
        if (!$settings->auto_backup_enabled) {
            $this->error('Auto backup is disabled. Please enable it first.');
            return;
        }
        
        $this->info('Creating test backup...');
        
        $backupDir = storage_path('app/backups');
        if (!file_exists($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $filename = 'test_backup_' . date('Y-m-d_H-i-s') . '.sql';
        $filepath = $backupDir . '/' . $filename;

        // Use full path to mysqldump for Windows XAMPP
        $mysqldumpPath = 'C:\xampp\mysql\bin\mysqldump.exe';
        if (!file_exists($mysqldumpPath)) {
            $mysqldumpPath = 'mysqldump'; // fallback to system PATH
        }
        
        $command = sprintf(
            '"%s" --user=%s --password=%s --host=%s --single-transaction --routines --triggers %s > "%s"',
            $mysqldumpPath,
            config('database.connections.mysql.username'),
            config('database.connections.mysql.password'),
            config('database.connections.mysql.host'),
            config('database.connections.mysql.database'),
            $filepath
        );

        exec($command, $output, $returnCode);

        if ($returnCode === 0 && file_exists($filepath) && filesize($filepath) > 0) {
            // Record backup history
            \App\Models\BackupHistory::create([
                'filename' => $filename,
                'type' => 'automatic',
                'file_size' => filesize($filepath),
                'created_by' => 'Test System',
                'created_at' => $now
            ]);
            
            $settings->update(['last_backup_at' => $now]);
            $this->info("Test backup created successfully: {$filename}");
            $this->info("File size: " . number_format(filesize($filepath) / 1024, 2) . " KB");
        } else {
            if (file_exists($filepath)) {
                unlink($filepath);
            }
            $this->error('Test backup failed - check database connection and permissions');
        }
    }
}