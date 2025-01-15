<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'jenis_kelamin',
        'jurusan'
    ];

    //rules validasi
    public static function rules($id = null)
    {
        return [
            'nis' => 'required|unique:siswas,nis,' . $id,
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
            'jurusan' => 'required'
        ];
    }
}
