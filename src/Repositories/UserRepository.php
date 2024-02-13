<?php

namespace App\Repositories;
use App\Core\Rules\AbstractRepository;
use App\DTOs\RegisterDTO;
use App\Entities\UserEntity;

class UserRepository extends AbstractRepository {
    public function createNewUser (RegisterDTO $form) {
        $newUserID = $this->insert("INSERT INTO user (email, password) VALUES (:email, :password)", [
            'email' => $form->email,
            'password' => password_hash($form->password, PASSWORD_BCRYPT),
        ]);

        $user = $this->findLastBy('id', $newUserID);

        if ($user) {
            return new UserEntity(
                $user->id,
                $user->name,
                $user->email,
                $user->password
            );
        }

        return null;
    }
}