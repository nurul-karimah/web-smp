<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $fillable = [
        'user_id',
        'bukti_pembayaran',
        'total_bayar',
        'digunakan_untuk',
        'tanggal_bayar',
        'status',
        'alasan',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class, 'user_id', 'user_id');
    }
}
