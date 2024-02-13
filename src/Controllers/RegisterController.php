<?php

namespace App\Controllers;

use App\Core\Enums\ApplicationEnvironment;
use App\Core\Route;
use App\Core\Validator;
use App\DTOs\RegisterDTO;
use App\Repositories\UserRepository;

class RegisterController {
    #[Route(path: '/', name: 'home', requestType: 'GET')]
    public function index(): void {
        echo 'Home page';
    }

    #[Route(path: '/register', name: 'register', requestType: 'POST')]
    public function register(Validator $validator, UserRepository $userRepository): void {
        $dto = new RegisterDTO([
            'email' => $_REQUEST['email'],
            'password' => $_REQUEST['password'],
            'password2' => $_REQUEST['password2'],
        ]);

        $errors = $validator->validate($dto);

        if (!empty($errors)) {
            return response([
                'success' => false,
                'errors' => $errors
            ]);
        }

        $newUser = $userRepository->createNewUser($dto);

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