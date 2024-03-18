<?php

namespace App\Service;

use App\Infrastructure\Classes\AbstractDTO;

/**
 * RegisterDTO class.
 *
 * This data transfer object (DTO) represents the data structure for a user.
 */
class RegisterDTO extends AbstractDTO {
    protected string $id;
    protected string $email;

    public function getId () {
        return $this->id;
    }

    public function getEmail () {
        return $this->email;
    }
}
