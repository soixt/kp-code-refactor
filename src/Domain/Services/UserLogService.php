<?php

namespace App\Domain\Services;

use App\Infrastructure\Enums\UserLogAction;
use App\Repositories\UserLogRepository;

class UserLogService {
    public function __construct(protected UserLogRepository $userLogRepository) {}
    /**
     * Log a new user log action.
     *
     * @param string|int $userID The ID of the user performing the action.
     * @param UserLogAction $action The action performed by the user.
     */
    public function newLog (string|int $userID, UserLogAction $action) {
        try {
            // Insert user log
            $this->userLogRepository->insert([
                'action' => $action->getLabel(),
                'user_id' => $userID,
            ]);
            
        } catch (\Throwable $th) {
            throw new \Exception("User log was not inserted.");
        }
    }
}