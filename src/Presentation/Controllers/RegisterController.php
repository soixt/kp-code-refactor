<?php

namespace App\Controllers;

use App\Infrastructure\Routing\Route;
use App\Domain\Services\UserService;
use App\Presentation\Validation\UserValidation;

/**
 * RegisterController
 * Handles user registration functionality.
 */
class RegisterController {
    /**
     * Index Action
     * Handles requests to the home page.
     */
    #[Route(path: '/', name: 'home', requestType: 'GET')]
    public function index(): void {
        echo 'Home page';
    }

    /**
     * Register Action
     * Handles user registration requests.
     * @return void JSON response indicating success or failure of the registration process.
     */
    #[Route(path: '/register', name: 'register', requestType: 'POST')]
    public function register(UserValidation $userValidation, UserService $userService): void {
        $newUser = $userService->createNewUser($userValidation);

        // Return success response
        response([
            'success' => true,
            'userId' => $newUser->getId()
        ]);
    }
}
