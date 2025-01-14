<?php

return [
    'brand' => 'ABSENSI SMK BUDI MULIA KARAWANG',
    'favicon' => '/images/logo-smk.png',

    'brand_logo' => [
        'dark' => '/images/logo-smk.png',
        'light' => '/images/logo-smk.png',
    ],
    'pages' => [
        'dashboard' => [
            'title' => 'Dashboard Absensi',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | This is the storage disk Filament will use to put media. You may use any
    | of the disks defined in the `config/filesystems.php`.
    |
    */
    'default_filesystem_disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),

    'layout' => [
        'sidebar' => [
            'is_collapsible_on_desktop' => true,
            'groups' => [
                'are_collapsible' => true,
            ],
        ],
    ],
];
