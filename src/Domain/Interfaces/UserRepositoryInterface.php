<?php

namespace App\Domain\Interfaces;
use App\Domain\Entities\UserEntity;

interface UserRepositoryInterface {
    public function findLastUserById (string $id): UserEntity|null;
}