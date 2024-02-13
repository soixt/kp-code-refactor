<?php

namespace App\Core\Interfaces;

interface RepositoryInterface {
    public function findBy(string $field, string $value): ?array;
    public function insert (string $query, array $params): mixed;
}