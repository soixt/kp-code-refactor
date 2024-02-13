<?php

namespace App\Core;

use App\Core\Database\Database;
use App\Core\Database\Interfaces\DatabaseAdapterInterface;
use App\Core\Interfaces\RepositoryInterface;

abstract class AbstractRepository implements RepositoryInterface
{
    protected DatabaseAdapterInterface $database;
    public function __construct() {
        $this->database = Database::getInstance()->getConnection();
    }

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

    public function findLastBy(string $field, string $value): mixed
    {
        $query = $this->database->query("SELECT * FROM user WHERE $field = :value ORDER BY id DESC LIMIT 1", [
            'value' => $value
        ]);
 
         // Fetch the results as an associative array
         $result = $query->Fetch(\PDO::FETCH_OBJ);
 
         // Return the result
         return $result;
    }

    public function insert (string $query, array $params): int
    {
        $query = $this->database->query($query, $params);
        // Return the last inserted ID
        return (int) $this->database->getConnection()->lastInsertId();
    }
}
