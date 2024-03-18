<?php

namespace App\Infrastructure\Database\Interfaces;

/**
 * DatabaseAdapterInterface
 *
 * This interface defines the contract for database adapter classes. Database adapter
 * classes are responsible for interacting with the underlying database system.
 */
interface DatabaseAdapterInterface {
    
    /**
     * Query method.
     *
     * Executes a query against the database.
     *
     * @param string $query The SQL query to execute.
     * @param array $params An associative array of parameter values for the query.
     * @return mixed The result of the query operation.
     */
    public function query(string $query, array $params = []): mixed;

    /**
     * Get connection method.
     *
     * Returns the underlying database connection object.
     *
     * @return mixed The database connection object.
     */
    public function getConnection(): mixed;
}
