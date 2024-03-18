<?php

namespace App\Domain\Services;

use App\Presentation\Validation\UserValidation;
use App\Domain\Entities\UserEntity;
use App\Infrastructure\Enums\ApplicationEnvironment;
use App\Infrastructure\Enums\UserLogAction;
use App\Infrastructure\Mail\Mailer;
use App\Repositories\UserRepository;

class UserService {
    public function __construct(protected UserRepository $userRepository, protected UserLogService $userLogService, protected Mailer $mailer) {}
    /**
     * Create a new user based on the provided registration form data.
     *
     * @param UserValidation $form The registration form data.
     * @return UserEntity|null Returns the created UserEntity object if successful, or null otherwise.
     */
    public function createNewUser (UserValidation $form, ) {
        try {
            // Insert new user data into the database
            $newUserID = $this->userRepository->insert([
                'email' => $form->email,
                'password' => password_hash($form->password, PASSWORD_BCRYPT),
            ]);

            // Find the newly created user by ID
            $user = $this->userRepository->findLastBy('id', $newUserID);

            // Write user log
            $this->userLogService->newLog($user->getId(), UserLogAction::REGISTER);

            // Send user welcome email
            $this->mailer->send('Welcome', 'Welcome to our site. Just confirm your email address...', $user->getEmail());
            
        } catch (\Throwable $th) {
            throw new \Exception("User was not created.");
        }
    }
}