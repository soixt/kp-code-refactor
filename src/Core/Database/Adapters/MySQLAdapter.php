<?php

namespace App\Core\Database\Adapters;

use App\Core\Database\Interfaces\DatabaseAdapterInterface;
use PDO;

/**
 * MySQLAdapter class.
 *
 * This class represents a database adapter for MySQL connections. It implements
 * the DatabaseAdapterInterface.
 */
class MySQLAdapter implements DatabaseAdapterInterface {
    /** @var PDO The PDO database connection. */
    protected PDO $connection;

    /**
     * Constructor.
     *
     * Initializes the MySQLAdapter with the specified configuration.
     *
     * @param array $config An associative array containing database connection configuration.
     */
    public function __construct(array $config = []) {
        $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'];
        $username = $config['username'];
        $password = $config['password'];
        $this->connection = new PDO($dsn, $username, $password);
    }

    /**
     * Get connection method.
     *
     * Returns the underlying PDO database connection.
     *
     * @return PDO The PDO database connection.
     */
    public function getConnection(): PDO {
        return $this->connection;
    }

    /**
     * Query method.
     *
     * Executes a query against the MySQL database.
     *
     * @param string $query The SQL query to execute.
     * @param array $params An associative array of parameter values for the query.
     * @return mixed The PDOStatement object representing the result of the query.
     */
    public function query(string $query, array $params = []): mixed {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);
        
        return $statement;
    }
}
