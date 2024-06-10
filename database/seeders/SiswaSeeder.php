<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'nisn' => '873262093',
                'nis' => '120304793',
                'nama' => "Student 1",
                'kelas_id' => 1,
                'alamat' => 'safdadsjkew',
                'no_hp' => '086536748',
            ],
        ];

        Siswa::insert($students);
    }
}
