<?php

namespace App\Core\Database;

use App\Core\Config;
use App\Core\Database\Adapters\MySQLAdapter;
use App\Core\Database\Interfaces\DatabaseAdapterInterface;
use InvalidArgumentException;

class Database {
    private static $instance = null;
    protected DatabaseAdapterInterface $adapter;

    private function __construct() {
        $dbConfig = Config::get('database.connection');

        $adapterConfig = Config::get('database.connections.' . $dbConfig);

        // Determine the appropriate adapter based on the database configuration
        switch ($dbConfig) {
            case 'mysql':
                $this->adapter = new MySQLAdapter($adapterConfig);
                break;
            default:
                throw new InvalidArgumentException('Unsupported database connection: ' . $dbConfig);
        }
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): DatabaseAdapterInterface {
        return $this->adapter;
    }
}
