<?php

return [
    /**
     * Database Connection Configuration
     * Defines the default database connection used by the application.
     * Default: 'mysql'
     */
    'connection' => env('DB_CONNECTION', 'mysql'),

    /**
     * Database Connections Configuration
     * Defines the settings for each supported database connection.
     */
    'connections' => [
        /**
         * MySQL Database Configuration
         * Configuration options for MySQL database connection.
         */
        'mysql' => [
            'host' => env('DB_HOST', '127.0.0.1'),     // Hostname or IP address of the MySQL server
            'port' => env('DB_PORT', 'mysql'),         // Port number of the MySQL server
            'dbname' => env('DB_NAME', 'kp'),          // Name of the MySQL database
            'charset' => env('DB_CHARSET', 'utf8mb4'), // Character set used for MySQL connection
            'username' => env('DB_USERNAME', 'root'),  // Username for MySQL connection
            'password' => env('DB_PASSWORD', ''),      // Password for MySQL connection
        ]
    ]
];
