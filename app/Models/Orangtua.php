<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Sudah cukup!
use Illuminate\Notifications\Notifiable;

class Orangtua extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'orangtua';

    protected $fillable = [
        'nik',
        'nama',
        'email',
        'password',
        'nomortelepon',
        'foto',
        'jenkel',
        'alamat'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'orangtua_id');
    }
}
