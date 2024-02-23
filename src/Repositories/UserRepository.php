<?php

namespace App\Repositories;

use App\Core\AbstractRepository;
use App\DTOs\RegisterDTO;
use App\Entities\UserEntity;

/**
 * UserRepository class.
 *
 * This class represents a repository for managing user data in the database.
 * It extends the AbstractRepository class and provides methods for creating new users
 * and creating the necessary database table if it does not exist.
 */
class UserRepository extends AbstractRepository {
    /**
     * Create a new user based on the provided registration form data.
     *
     * @param RegisterDTO $form The registration form data.
     * @return UserEntity|null Returns the created UserEntity object if successful, or null otherwise.
     */
    public function createNewUser (RegisterDTO $form) {
        // Insert new user data into the database
        $newUserID = $this->insert("INSERT INTO user (email, password) VALUES (:email, :password)", [
            'email' => $form->email,
            'password' => password_hash($form->password, PASSWORD_BCRYPT),
        ]);

        // Find the newly created user by ID
        $user = $this->findLastBy('id', $newUserID);

        // If user is found, create a UserEntity object and return it
        if ($user) {
            return new UserEntity(
                $user->id,
                $user->email,
                $user->password
            );
        }

        // Return null if user creation fails
        return null;
    }
}
