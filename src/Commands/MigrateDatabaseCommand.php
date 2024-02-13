<?php

namespace App\Commands;
use App\Core\Interfaces\CommandInterface;
use App\Repositories\UserLogRepository;
use App\Repositories\UserRepository;

class MigrateDatabaseCommand implements CommandInterface {
    public static function handle(...$args): void {
        $userRepository = new UserRepository;
        $userLogRepository = new UserLogRepository;

        $userRepository->createTableIfNotExists();
        $userLogRepository->createTableIfNotExists();
    }
}