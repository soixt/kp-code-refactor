<?php

namespace App\Core\Database\Interfaces;

interface DatabaseAdapterInterface {
    public function query(string $query, array $params = []): mixed;
    public function getConnection(): mixed;
}