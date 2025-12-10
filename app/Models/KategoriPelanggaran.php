<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPelanggaran extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['id', 'nama'];
    
    public static function all($columns = ['*'])
    {
        return collect([
            (object) ['id' => 'I', 'nama' => 'I. Kepribadian (Sikap)'],
            (object) ['id' => 'II', 'nama' => 'II. Kerajinan'],
            (object) ['id' => 'III', 'nama' => 'III. Kerapian']
        ]);
    }
    
    public function jenisPelanggaran()
    {
        return $this->hasMany(JenisPelanggaran::class, 'kategori', 'id');
    }
}