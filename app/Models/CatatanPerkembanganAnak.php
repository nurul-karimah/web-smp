<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanPerkembanganAnak extends Model
{
    use HasFactory;

    protected $table = 'catatan_perkembangan_anak';

    protected $fillable = [
        'siswa_id',
        'dataakademik_id',
        'absensi_id',
        'kehadiran',
        'catatan_khusus',
        'tanggapan_orang_tua',
        'tanggal_pencatatan',
    ];


    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function date_akademik_paud()
    {
        return $this->belongsTo(DataAkademikPaud::class, 'dataakademik_id');
    }
    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'absensi_id');
    }
}
