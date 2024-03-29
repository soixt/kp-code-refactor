<?php

namespace App\Entities;

class UserEntity {
    protected int|string $id;
    protected string $email;
    protected string $password;

    public function __construct(int|string $id, string $email, string $password) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId () {
        return $this->id;
    }

    public function setId (string|int $id) {
        return $this->id = $id;
    }

    public function getEmail () {
        return $this->email;
    }

    public function setEmail (string $email) {
        return $this->email = $email;
    }

    public function getPassword () {
        return $this->password;
    }

    public function setPassword (string $password) {
        return $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPassword(string $password): bool {
        return password_verify($password, $this->password);
    }
}