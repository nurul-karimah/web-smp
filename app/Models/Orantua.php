<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Menggunakan Authenticatable
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Orantua extends Authenticatable implements AuthAuthenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'orantua';

    protected $fillable = [
        'nik',
        'nama',
        'email',
        'password',
        'nomertelepon',
        'foto',
        'jenkel',
        'alamat'

    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'orangtua_id');
    }
}
