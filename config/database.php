<?php

return [
    'connection' => env('DB_CONNECTION', 'mysql'),
    'connections' => [
        'mysql' => [
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', 'mysql'),
            'dbname' => env('DB_NAME', 'kp'),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
        ]
    ]
];