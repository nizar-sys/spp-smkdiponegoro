<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = [
            [
                'kelas' => "10",
                'kompetensi_keahlian' => "Rekayasa Perangkat Lunak",
                'kode_kelas' => '10-RPL',
                'nominal_spp' => '12345781267',
                'tahun_ajaran' => '2021'
            ],
            [
                'kelas' => "11",
                'kompetensi_keahlian' => "Rekayasa Perangkat Lunak",
                'kode_kelas' => '11-RPL',
                'nominal_spp' => '162512722',
                'tahun_ajaran' => '2021'
            ],
            [
                'kelas' => "12",
                'kompetensi_keahlian' => "Rekayasa Perangkat Lunak",
                'kode_kelas' => '12-RPL',
                'nominal_spp' => '238972398',
                'tahun_ajaran' => '2021'
            ],
        ];

        Kelas::insert($classes);
    }
}
