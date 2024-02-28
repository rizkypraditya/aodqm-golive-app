<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'naya',
                'email' => 'islainayahbahar@gmail.com',
                'email_verified_at' => now(),
                'roles' => 'admin',
                'password' => Hash::make('admin123'),
            ],
            [
                'username' => 'Zaiful Andir',
                'email' => 'zaifulandri@gmail.com',
                'email_verified_at' => now(),
                'roles' => 'mitra',
                'password' => Hash::make('mitra123'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
