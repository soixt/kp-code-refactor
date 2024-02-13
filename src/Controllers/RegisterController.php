<?php

namespace App\Controllers;

use App\Core\Enums\ApplicationEnvironment;
use App\Core\Enums\UserLogAction;
use App\Core\Route;
use App\Core\Validator;
use App\DTOs\RegisterDTO;
use App\Repositories\UserLogRepository;
use App\Repositories\UserRepository;

class RegisterController {
    protected Validator $validator;

    public function __construct() {
        $this->validator = new Validator();
    }

    #[Route(path: '/', name: 'home', requestType: 'GET')]
    public function index(): void {
        echo 'Home page';
    }

    #[Route(path: '/register', name: 'register', requestType: 'POST')]
    public function register() {
        $dto = new RegisterDTO([
            'email' => $_REQUEST['email'],
            'password' => $_REQUEST['password'],
            'password2' => $_REQUEST['password2'],
        ]);

        $errors = $this->validator->validate($dto);

        if (!empty($errors)) {
            return response([
                'success' => false,
                'errors' => $errors
            ]);
        }

        $userRepository = new UserRepository;

        $newUser = $userRepository->createNewUser($dto);

        $userLogRepository = new UserLogRepository;

        $userLogRepository->newLog($newUser->getId(), UserLogAction::REGISTER->value);

        if (config('app.env') === ApplicationEnvironment::PROD) {
            mail(
                $newUser->getEmail(),
                'Dobro došli',
                'Dobro dosli na nas sajt. Potrebno je samo da potvrdite email adresu ...',
                'adm@kupujemprodajem.com'
            );
        }

        $_SESSION['userId'] = $newUser->getId();

        return response([
            'success' => true,
            'userId' => $newUser->getId()
        ]);
    }
}