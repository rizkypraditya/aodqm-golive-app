<?php

return [
    [
        'title' => 'Beranda',
        'icon' => 'home',
        'route-name' => 'home',
        'is-active' => 'home',
        'description' => 'Untuk melihat ringkasan aplikasi.',
        'roles' => ['admin', 'users'],
    ],

    [
        'title' => 'Master',
        'icon' => 'database',
        'route-name' => 'master.siswa.index',
        'is-active' => 'master*',
        'category' => 'main',
        'description' => 'Menyimpan data inti aplikasi.',
        'roles' => ['admin'],
        'sub-menus' => [
            [
                'title' => 'Mitra',
                'route-name' => 'master.mitra.index',
                'is-active' => 'master.mitra*',
                'description' => 'Melihat daftar mitra.',
            ],
            [
                'title' => 'Pengguna',
                'route-name' => 'master.user.index',
                'is-active' => 'master.user*',
                'description' => 'Melihat daftar pengguna.',
            ],
        ],
    ],

];
