<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Guru extends Model
{
    protected $table = 'guru';
    
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'nip',
        'mata_pelajaran',
        'jabatan',
        'wali_kelas',
        'tanggal_masuk_kerja',
        'user_id'
    ];
    
    protected $dates = ['tanggal_lahir', 'tanggal_masuk_kerja'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public static function rules($id = null)
    {
        return [
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:guru,nip,' . $id,
            'mata_pelajaran' => 'required|string|max:255',
            'wali_kelas' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('guru', 'wali_kelas')->ignore($id)
            ]
        ];
    }
}