<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaksanaanSanksi extends Model
{
    use HasFactory;

    protected $table = 'pelaksanaan_sanksi';

    protected $fillable = [
        'siswa_id',
        'jenis_sanksi',
        'deskripsi_sanksi',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'bukti_pelaksanaan',
        'catatan',
        'user_id'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}