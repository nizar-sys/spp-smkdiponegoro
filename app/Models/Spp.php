<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'nominal',
        'tanggal',
        'bulan',
        'tahun',
        'status'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'spp_id', 'id');
    }

    public function onePembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'spp_id', 'id');
    }
}
