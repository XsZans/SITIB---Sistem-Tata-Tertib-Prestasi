<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackupSetting extends Model
{
    protected $fillable = [
        'auto_backup_enabled',
        'backup_frequency',
        'backup_time',
        'keep_backups',
        'last_backup_at'
    ];

    protected $casts = [
        'auto_backup_enabled' => 'boolean',
        'last_backup_at' => 'datetime'
    ];

    public static function getSettings()
    {
        $settings = self::first();
        if (!$settings) {
            $settings = self::create([
                'auto_backup_enabled' => false,
                'backup_frequency' => 'daily',
                'backup_time' => '02:00:00',
                'keep_backups' => 7
            ]);
        }
        return $settings;
    }
}