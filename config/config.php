<?php

return [
    'app' => env('CONSTANT_APP', null),

    'default' => env('DB_CONNECTION', 'database'),

    'cache_path' => env('CONSTANT_CACHE_PATH', storage_path('_constant.php')),

    'connections' => [

        'database' => [
            'driver' => 'database',
            'table' => 'constants',
            'connection' => null,
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'cache',
        ],
    ]
];