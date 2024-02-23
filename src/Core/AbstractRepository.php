<?php

namespace App\Core;

use App\Core\Database\Database;
use App\Core\Database\Interfaces\DatabaseAdapterInterface;
use App\Core\Interfaces\RepositoryInterface;

/**
 * AbstractRepository class.
 *
 * This abstract class serves as a base for repository classes. It provides
 * common functionality for interacting with the database.
 */
abstract class AbstractRepository implements RepositoryInterface
{
    /** @var DatabaseAdapterInterface The database adapter instance. */
    protected DatabaseAdapterInterface $database;

    /**
     * Constructor.
     *
     * Initializes the repository with a database connection.
     */
    public function __construct() {
        $this->database = Database::getInstance()->getConnection();
    }

    /**
     * Find by method.
     *
     * Retrieves records from the database based on a specified field and value.
     *
     * @param string $field The name of the field to search by.
     * @param string $value The value to search for in the specified field.
     * @return array|null An array of matching records, or null if no records are found.
     */
    public function findBy(string $field, string $value): ?array
    {
        $query = $this->database->query("SELECT * FROM user WHERE $field = :value", [
            'value' => $value
        ]);
 
        // Fetch the results as an associative array
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
 
        // Return the result
        return $result ?: [];
    }

    /**
     * Find last by method.
     *
     * Retrieves the last record from the database based on a specified field and value.
     *
     * @param string $field The name of the field to search by.
     * @param string $value The value to search for in the specified field.
     * @return mixed The last matching record.
     */
    public function findLastBy(string $field, string $value): mixed
    {
        $query = $this->database->query("SELECT * FROM user WHERE $field = :value ORDER BY id DESC LIMIT 1", [
            'value' => $value
        ]);
 
        // Fetch the result as an object
        $result = $query->Fetch(\PDO::FETCH_OBJ);
 
        // Return the result
        return $result;
    }

    /**
     * Insert method.
     *
     * Executes an insert query on the database.
     *
     * @param string $query The SQL query to execute.
     * @param array $params An associative array of parameter values for the query.
     * @return int The ID of the last inserted row.
     */
    public function insert (string $query, array $params): int
    {
        $query = $this->database->query($query, $params);
        
        // Return the last inserted ID
        return (int) $this->database->getConnection()->lastInsertId();
    }
}
