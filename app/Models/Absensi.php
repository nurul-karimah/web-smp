<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';

    protected $fillable  = [
        'siswa_id',
        'semester',
        'tanggal',
        'status',
        'keterangan',
        'gambar',
        'lokasi',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
