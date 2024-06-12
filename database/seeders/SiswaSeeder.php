<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = [
            [
                'nis' => '120304793',
                'nama' => "Student 1",
                'kelas_id' => 1,
                'alamat' => 'safdadsjkew',
                'no_hp' => '086536748',
                'tempat_tanggal_lahir' => 'Jakarta, 12-03-2004',
                'jenis_kelamin' => 'Laki-laki',
                'password' => Hash::make('password'),
            ],
        ];

        Siswa::insert($students);
    }
}
