<?php

namespace App\Infrastructure\Database\Interfaces;

/**
 * RepositoryInterface
 *
 * This interface defines the contract for repository classes. Repository classes are used
 * to interact with data storage, such as databases or APIs, and perform CRUD operations.
 */
interface RepositoryInterface {
    
    /**
     * Find by method.
     *
     * Retrieves records from the data storage based on a specified field and value.
     *
     * @param string $field The field to search by.
     * @param string $value The value to search for.
     * @return array|null An array of matching records or null if none found.
     */
    public function findBy(string $field, string $value): ?array;

    /**
     * Insert method.
     *
     * Inserts data into the data storage using a specified query and parameters.
     *
     * @param array $params An associative array of parameter values for the query.
     * @return mixed The result of the insertion operation, typically an insert ID or boolean.
     */
    public function insert(array $params): mixed;
}
