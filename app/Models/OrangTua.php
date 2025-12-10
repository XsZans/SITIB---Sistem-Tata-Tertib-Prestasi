<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;

    protected $table = 'orang_tua';

    protected $fillable = [
        'siswa_id',
        'nama_ayah',
        'nama_ibu',
        'no_hp',
        'alamat',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}