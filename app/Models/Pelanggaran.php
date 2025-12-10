<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $table = 'pelanggaran';

    protected $fillable = [
        'siswa_id',
        'jenis_pelanggaran_id',
        'user_id',
        'pengadu_id',
        'tanggal_pelanggaran',
        'keterangan',
        'bukti_gambar',
        'status',
        'alasan_tolak',
        'verifikator_id',
        'tanggal_verifikasi'
    ];

    protected $casts = [
        'tanggal_pelanggaran' => 'date',
        'tanggal_verifikasi' => 'datetime'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function jenisPelanggaran()
    {
        return $this->belongsTo(JenisPelanggaran::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengadu()
    {
        return $this->belongsTo(User::class, 'pengadu_id');
    }

    public function sanksi()
    {
        return $this->hasMany(Sanksi::class);
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'verifikator_id');
    }
}