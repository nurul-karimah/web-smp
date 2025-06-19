<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Menggunakan Authenticatable
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Guru extends Authenticatable implements AuthenticatableContract // Implementasikan AuthenticatableContract
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'guru'; // Nama tabel di database

    protected $fillable = [
        'nip',
        'nama',
        'email',
        'password',
        'tgl_lahir',
        'foto',
        'jenkel',
        'alamat'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
