<?php

namespace App\Repositories;
use App\Core\AbstractRepository;
use App\Core\Enums\UserLogAction;

class UserLogRepository extends AbstractRepository {
    public function newLog (string|int $userID, UserLogAction $action) {
        $this->insert("INSERT INTO user_log (action, user_id) VALUES (:action, :user_id)", [
            'action' => $action->getLabel(),
            'user_id' => $userID,
        ]);
    }

    public function createTableIfNotExists(): void {
        $sql = "CREATE TABLE IF NOT EXISTS user_log (
            id INT AUTO_INCREMENT PRIMARY KEY,
            action VARCHAR(255) NOT NULL,
            user_id INT NOT NULL,
            log_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES user(id)
        )";
    
        $this->database->query($sql);
    }
}