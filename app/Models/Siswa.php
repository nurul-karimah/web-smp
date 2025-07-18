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
        'tgl_lahir',
        'usia',
        'jenis_kelamin',
        'foto',
        'orangtua_id'
    ];

    public function orangtua()
    {
        return $this->belongsTo(Orangtua::class, 'orangtua_id');
    }
}
