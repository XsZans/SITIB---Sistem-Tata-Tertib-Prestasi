<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BackupSetting;
use Carbon\Carbon;

class AutoBackupCommand extends Command
{
    protected $signature = 'backup:auto';
    protected $description = 'Run automatic database backup based on settings';

    public function handle()
    {
        $settings = BackupSetting::getSettings();
        $now = \Carbon\Carbon::now('Asia/Jakarta');
        
        $this->info("Current time: {$now->format('Y-m-d H:i:s')} (Asia/Jakarta)");
        $this->info("Backup enabled: " . ($settings->auto_backup_enabled ? 'Yes' : 'No'));
        $this->info("Backup time: {$settings->backup_time}");
        $this->info("Backup frequency: {$settings->backup_frequency}");
        
        if (!$settings->auto_backup_enabled) {
            $this->info('Auto backup is disabled');
            return;
        }

        $shouldBackup = $this->shouldRunBackup($settings);
        
        if (!$shouldBackup) {
            $this->info('Backup not needed at this time');
            return;
        }

        $this->info('Starting automatic backup...');
        
        $backupDir = storage_path('app/backups');
        if (!file_exists($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $filename = 'auto_backup_' . date('Y-m-d_H-i-s') . '.sql';
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
                'created_by' => 'System',
                'created_at' => now()
            ]);
            
            $settings->update(['last_backup_at' => \Carbon\Carbon::now('Asia/Jakarta')]);
            $this->cleanOldBackups($settings);
            $this->info("Backup created successfully: {$filename}");
            $this->info("File size: " . number_format(filesize($filepath) / 1024, 2) . " KB");
        } else {
            // Clean up failed backup file
            if (file_exists($filepath)) {
                unlink($filepath);
            }
            $this->error('Backup failed - check database connection and permissions');
        }
    }

    private function shouldRunBackup($settings)
    {
        $now = Carbon::now('Asia/Jakarta');
        $backupTime = Carbon::createFromFormat('H:i:s', $settings->backup_time, 'Asia/Jakarta');
        $backupTime->setDate($now->year, $now->month, $now->day);
        
        // Check if it's time for backup (within 5 minutes window)
        $timeDiff = abs($now->diffInMinutes($backupTime));
        if ($timeDiff > 5) {
            $this->info("Not backup time yet. Current: {$now->format('H:i')}, Scheduled: {$backupTime->format('H:i')}");
            return false;
        }
        
        if (!$settings->last_backup_at) {
            return true;
        }

        $lastBackup = Carbon::parse($settings->last_backup_at, 'Asia/Jakarta');

        switch ($settings->backup_frequency) {
            case 'daily':
                return $lastBackup->diffInDays($now) >= 1;
            case 'weekly':
                return $lastBackup->diffInWeeks($now) >= 1;
            case 'monthly':
                return $lastBackup->diffInMonths($now) >= 1;
            default:
                return false;
        }
    }

    private function cleanOldBackups($settings)
    {
        $backupDir = storage_path('app/backups');
        $files = glob($backupDir . '/auto_backup_*.sql');
        
        if (count($files) > $settings->keep_backups) {
            usort($files, function($a, $b) {
                return filemtime($a) - filemtime($b);
            });
            
            $filesToDelete = array_slice($files, 0, count($files) - $settings->keep_backups);
            foreach ($filesToDelete as $file) {
                $filename = basename($file);
                // Remove from backup history
                \App\Models\BackupHistory::where('filename', $filename)->delete();
                // Delete physical file
                unlink($file);
                $this->info("Deleted old backup: {$filename}");
            }
        }
    }
}