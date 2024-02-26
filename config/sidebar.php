<?php

return [
    [
        'title' => 'Beranda',
        'icon' => 'home',
        'route-name' => 'home',
        'is-active' => 'home',
        'description' => 'Untuk melihat ringkasan aplikasi.',
        'roles' => ['admin', 'users', 'mitra'],
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

    [
        'title' => 'Laporan',
        'icon' => 'file-alt',
        'route-name' => 'report.index',
        'is-active' => 'report*',
        'description' => 'Daftar laporan.',
        'roles' => ['admin', 'users', 'mitra'],
    ],

    [
        'title' => 'Pengaturan',
        'description' => 'Menampilkan pengaturan aplikasi.',
        'icon' => 'cog',
        'route-name' => 'setting.profile.index',
        'is-active' => 'setting*',
        'roles' => ['admin', 'user', 'mitra'],
        'sub-menus' => [
            [
                'title' => 'Profil',
                'description' => 'Melihat pengaturan profil.',
                'route-name' => 'setting.profile.index',
                'is-active' => 'setting.profile*',
            ],
            [
                'title' => 'Akun',
                'description' => 'Melihat pengaturan akun.',
                'route-name' => 'setting.account.index',
                'is-active' => 'setting.account*',
            ],
        ],
    ],

];
