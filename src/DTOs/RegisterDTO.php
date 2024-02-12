<?php

namespace App\DTOs;
use App\Core\AbstractDTO;
use App\Rules\IsNotEmptyRule;

class RegisterDTO extends AbstractDTO {
    #[IsNotEmptyRule]
    protected string $email;
}