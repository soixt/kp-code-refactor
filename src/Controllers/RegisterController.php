<?php

namespace App\Controllers;

use App\Core\Enums\ApplicationEnvironment;
use App\Core\Enums\UserLogAction;
use App\Core\Route;
use App\Core\Validator;
use App\DTOs\RegisterDTO;
use App\Repositories\UserLogRepository;
use App\Repositories\UserRepository;

/**
 * RegisterController
 * Handles user registration functionality.
 */
class RegisterController {
    protected Validator $validator;

    /**
     * Constructor
     * Initializes the validator instance.
     */
    public function __construct() {
        $this->validator = new Validator();
    }

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
     * Validates user input, creates a new user, logs the registration action, sends a confirmation email (in production), and sets the user session.
     * @return array JSON response indicating success or failure of the registration process.
     */
    #[Route(path: '/register', name: 'register', requestType: 'POST')]
    public function register() {
        // Create a DTO object with user registration data
        $dto = new RegisterDTO([
            'email' => $_REQUEST['email'],
            'password' => $_REQUEST['password'],
            'password2' => $_REQUEST['password2'],
        ]);

        // Validate user input
        $errors = $this->validator->validate($dto);

        // If validation errors exist, return error response
        if (!empty($errors)) {
            return response([
                'success' => false,
                'errors' => $errors
            ]);
        }

        // Create a new user
        $userRepository = new UserRepository;
        $newUser = $userRepository->createNewUser($dto);

        // Log the registration action
        $userLogRepository = new UserLogRepository;
        $userLogRepository->newLog($newUser->getId(), UserLogAction::REGISTER);

        // Send confirmation email in production environment
        if (config('app.env') === ApplicationEnvironment::PROD) {
            mail(
                $newUser->getEmail(),
                'Welcome',
                'Welcome to our site. Just confirm your email address...',
                'admin@example.com'
            );
        }

        // Set user session
        $_SESSION['userId'] = $newUser->getId();

        // Return success response
        return response([
            'success' => true,
            'userId' => $newUser->getId()
        ]);
    }
}
