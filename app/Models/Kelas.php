<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas',
        'kompetensi_keahlian',
        'kode_kelas',
        'nominal_spp',
        'tahun_ajaran'
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
