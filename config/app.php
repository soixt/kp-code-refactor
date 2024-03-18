<?php

return [
    /**
     * Environment Configuration
     * The environment the application is running in.
     * Default: 'local'
     */
    'env' => env('APP_ENV', 'local'),

    /**
     * Root Directory Configuration
     * The root directory of the application.
     */
    'root' => __DIR__ . '../',
    'migrations_path' => __DIR__ . '../database/migrations/',
];
