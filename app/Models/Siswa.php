<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nisn',
        'nis',
        'nama',
        'kelas_id',
        'alamat',
        'no_hp',
    ];

    protected $appends = [
        'nama_kelas',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function NamaKelas(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->kelas->kompetensi_keahlian . ' ' . $this->kelas->kelas,
        );
    }

    public function spps()
    {
        return $this->hasMany(Spp::class, 'siswa_id', 'id');
    }
}
