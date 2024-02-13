<?php

namespace App\Core\Database\Adapters;

use App\Core\Database\Interfaces\DatabaseAdapterInterface;
use PDO;

class MySQLAdapter implements DatabaseAdapterInterface {
    protected PDO $connection;

    public function __construct(array $config = []) {
        $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'];
        $username = $config['username'];
        $password = $config['password'];
        $this->connection = new PDO($dsn, $username, $password);
    }

    public function getConnection ():mixed {
        return $this->connection;
    }

    public function query(string $query, array $params = []): mixed {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);
        
        return $statement;
    }
}