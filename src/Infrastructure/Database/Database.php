<?php

namespace App\Infrastructure\Database;

use App\Core\Config;
use App\Infrastructure\Database\Adapters\MySQLAdapter;
use App\Infrastructure\Database\Interfaces\DatabaseAdapterInterface;
use InvalidArgumentException;

/**
 * Database class.
 *
 * This class represents the database connection manager. It provides a singleton
 * instance of the database adapter based on the configuration.
 */
class Database {
    /** @var Database|null The singleton instance of the Database class. */
    private static $instance = null;

    /** @var DatabaseAdapterInterface The database adapter instance. */
    protected DatabaseAdapterInterface $adapter;

    /**
     * Constructor.
     *
     * Initializes the database connection based on the configuration.
     */
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

    /**
     * Get instance method.
     *
     * Returns the singleton instance of the Database class.
     *
     * @return self The Database instance.
     */
    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get connection method.
     *
     * Returns the database adapter instance.
     *
     * @return DatabaseAdapterInterface The database adapter instance.
     */
    public function getConnection(): DatabaseAdapterInterface {
        return $this->adapter;
    }
}
