<?php

namespace App\Entities;

/**
 * UserEntity class.
 *
 * This class represents a user entity in the application, containing properties and methods
 * related to user data manipulation and retrieval.
 */
class UserEntity {
    /**
     * The unique identifier for the user.
     *
     * @var int|string
     */
    protected int|string $id;

    /**
     * The email address of the user.
     *
     * @var string
     */
    protected string $email;

    /**
     * The hashed password of the user.
     *
     * @var string
     */
    protected string $password;

    /**
     * Constructs a new UserEntity object.
     *
     * @param int|string $id The unique identifier for the user.
     * @param string $email The email address of the user.
     * @param string $password The hashed password of the user.
     */
    public function __construct(int|string $id, string $email, string $password) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Get the unique identifier of the user.
     *
     * @return int|string The unique identifier of the user.
     */
    public function getId () {
        return $this->id;
    }

    /**
     * Set the unique identifier of the user.
     *
     * @param int|string $id The unique identifier of the user.
     */
    public function setId (int|string $id) {
        return $this->id = $id;
    }

    /**
     * Get the email address of the user.
     *
     * @return string The email address of the user.
     */
    public function getEmail () {
        return $this->email;
    }

    /**
     * Set the email address of the user.
     *
     * @param string $email The email address of the user.
     */
    public function setEmail (string $email) {
        return $this->email = $email;
    }

    /**
     * Get the hashed password of the user.
     *
     * @return string The hashed password of the user.
     */
    public function getPassword () {
        return $this->password;
    }

    /**
     * Set and hash the password of the user.
     *
     * @param string $password The password to set and hash.
     */
    public function setPassword (string $password) {
        return $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Verify if a given password matches the hashed password of the user.
     *
     * @param string $password The password to verify.
     * @return bool True if the password matches, false otherwise.
     */
    public function verifyPassword(string $password): bool {
        return password_verify($password, $this->password);
    }
}
