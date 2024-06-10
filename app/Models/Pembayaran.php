<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'kd_transaksi',
        'petugas_id',
        'siswa_id',
        'spp_id',
        'tgl_bayar',
        'bulan_dibayar',
        'tahun_dibayar',
        'jumlah_bayar',
    ];
}
