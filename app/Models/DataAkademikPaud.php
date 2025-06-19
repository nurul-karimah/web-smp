<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAkademikPaud extends Model
{
    use HasFactory;
    protected $table = 'date_akademik_paud';

    protected $fillable = [
        'siswa_id',
        'guru_id',
        'perkembangan_fisik',
        'perkembangan_kognitif',
        'perkembangan_sosial_emosional',
        'perkembangan_bahasa',
        'kegiatan_belajar',
        'semester',
        'tahun_ajaran',
        'nilai_fisik',
        'nilai_kognitif',
        'nilai_sosial',
        'nilai_bahasa',
        'nilai_belajar',
        'jumlah',
        'grade',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
