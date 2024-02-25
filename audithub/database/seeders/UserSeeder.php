<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeader extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $UserData = [
            [
                'name'=> 'manag',
                'email'=> 'managaer@gmail.com',
                'role'=> 'admin',
                'password'=>bcrypt ('12345')
            ],

            [
                'name'=> 'yusuf',
                'email'=> 'yusuf@gmail.com',
                'role'=> 'telkom',
                'password'=>bcrypt ('12345')
            ],

            [
                'name'=> 'bagas',
                'email'=> 'bagas@gmail.com',
                'role'=> 'mitra',
                'password'=>bcrypt ('12345')
            ],

        ];

        foreach($UserData as $key => $val){
            User::create($val);

        }
    }
}
