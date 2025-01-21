<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'jam_masuk',
        'status',
        'keterangan'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam_masuk' => 'datetime'
    ];

    protected $attributes = [
        'status' => 'hadir', // Default status
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
