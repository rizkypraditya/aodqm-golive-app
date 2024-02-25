<?php

namespace Database\Seeders;

use App\Models\Mitra;
use Illuminate\Database\Seeder;

class MitraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mitras = [
            [
                'user_id' => 2,
                'name' => 'Zaiful Andir',
                'email' => 'zaifulandri@gmail.com',
                'phone' => '085883938292',
                'address' => 'Makassar, Jl Bumi Permata Sudiang',
                'gender' => 'laki-laki',
            ],
        ];

        foreach ($mitras as $mitra) {
            Mitra::create($mitra);
        }
    }
}
