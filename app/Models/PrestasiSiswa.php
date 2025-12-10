<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiSiswa extends Model
{
    use HasFactory;

    protected $table = 'prestasi_siswa';

    protected $fillable = [
        'siswa_id',
        'prestasi_id',
        'user_id',
        'pengadu_id',
        'tanggal_prestasi',
        'keterangan',
        'bukti_gambar',
        'status',
        'alasan_tolak',
        'verifikator_id',
        'tanggal_verifikasi'
    ];

    protected $casts = [
        'tanggal_prestasi' => 'datetime',
        'tanggal_verifikasi' => 'datetime'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function prestasi()
    {
        return $this->belongsTo(Prestasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengadu()
    {
        return $this->belongsTo(User::class, 'pengadu_id');
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'verifikator_id');
    }
}