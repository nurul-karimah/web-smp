<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'no_pendaftaran',
        'nisn',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'penerima_kip',
        'alamat',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'sekolah_asal',
        'dokumen_ijazah',
        'dokumen_kk',
        'dokumen_raport',
        'nilai_raport_akhir',
        'status',
        'alasan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
