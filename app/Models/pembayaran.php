<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran'; // <- tambahkan ini jika nama tabel tidak pakai 's'

    protected $fillable = [
        'user_id',
        'jumlah_tagihan',
        'tanggal_tagihan',
        'bukti_pembayaran',
        'status_pembayaran',
    ];
}
