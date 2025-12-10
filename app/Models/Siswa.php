<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nis',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'alamat',
        'kelas',
        'jurusan',
        'poin_pelanggaran',
        'poin_prestasi',
        'jumlah_pelanggaran',
        'user_id',
        'orang_tua_user_id'
    ];
    
    protected $dates = ['tanggal_lahir'];

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class);
    }
    
    public function prestasiSiswa()
    {
        return $this->hasMany(PrestasiSiswa::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function orangTua()
    {
        return $this->hasOne(OrangTua::class);
    }
    
    public function orangTuaUser()
    {
        return $this->belongsTo(User::class, 'orang_tua_user_id');
    }
}