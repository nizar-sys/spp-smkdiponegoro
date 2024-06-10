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
                'nominal_spp' => '1500000'
            ],
            [
                'kelas' => "11",
                'kompetensi_keahlian' => "Rekayasa Perangkat Lunak",
                'kode_kelas' => '11-RPL',
                'nominal_spp' => '1500000'
            ],
            [
                'kelas' => "12",
                'kompetensi_keahlian' => "Rekayasa Perangkat Lunak",
                'kode_kelas' => '12-RPL',
                'nominal_spp' => '1500000'
            ],
        ];

        Kelas::insert($classes);
    }
}
