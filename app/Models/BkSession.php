<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BkSession extends Model
{
    protected $fillable = [
        'siswa_id',
        'guru_bk_id',
        'jenis',
        'alasan',
        'tujuan_bimbingan',
        'jam_bimbingan',
        'catatan_bk',
        'status',
        'respon_siswa',
        'alasan_siswa',
        'jadwal_bk',
        'hasil_bk'
    ];

    protected $casts = [
        'jadwal_bk' => 'datetime'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function guruBk()
    {
        return $this->belongsTo(Guru::class, 'guru_bk_id');
    }

    public function notifications()
    {
        return $this->hasMany(BkNotification::class);
    }
}