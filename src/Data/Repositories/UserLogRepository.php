<?php

namespace App\Repositories;

use App\Infrastructure\Database\AbstractRepository;

/**
 * UserLogRepository class.
 *
 * This class represents a repository for managing user log data in the database.
 * It extends the AbstractRepository class and provides methods for logging user actions
 * and creating the necessary database table if it does not exist.
 */
class UserLogRepository extends AbstractRepository {
    protected $tableName = 'user_log';
}
