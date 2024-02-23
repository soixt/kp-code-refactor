<?php

namespace App\Repositories;

use App\Core\AbstractRepository;
use App\Core\Enums\UserLogAction;

/**
 * UserLogRepository class.
 *
 * This class represents a repository for managing user log data in the database.
 * It extends the AbstractRepository class and provides methods for logging user actions
 * and creating the necessary database table if it does not exist.
 */
class UserLogRepository extends AbstractRepository {
    /**
     * Log a new user action.
     *
     * @param string|int $userID The ID of the user performing the action.
     * @param UserLogAction $action The action performed by the user.
     */
    public function newLog (string|int $userID, UserLogAction $action) {
        $this->insert("INSERT INTO user_log (action, user_id) VALUES (:action, :user_id)", [
            'action' => $action->getLabel(),
            'user_id' => $userID,
        ]);
    }
}
