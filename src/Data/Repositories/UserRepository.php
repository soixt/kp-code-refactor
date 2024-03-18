<?php

namespace App\Repositories;

use App\Domain\Entities\UserEntity;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Infrastructure\Database\AbstractRepository;

/**
 * UserRepository class.
 *
 * This class represents a repository for managing user data in the database.
 */
class UserRepository extends AbstractRepository implements UserRepositoryInterface {
    protected string $tableName = 'user';

    public function findLastUserById (string $id): UserEntity|null {
        $user = $this->findLastBy('id', $id) ?? null;

        if ($user) {
            return new UserEntity(
                $user->id,
                $user->email,
                $user->password
            );
        }

        return null;
    }
}
