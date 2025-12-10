<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPelanggaran extends Model
{
    use HasFactory;

    protected $table = 'jenis_pelanggaran';

    protected $fillable = [
        'nama_pelanggaran',
        'deskripsi',
        'poin',
        'kategori'
    ];
    
    public static function getKategoriOptions()
    {
        return [
            'I' => 'I. Kepribadian (Sikap)',
            'II' => 'II. Kerajinan',
            'III' => 'III. Kerapian'
        ];
    }

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class);
    }
}