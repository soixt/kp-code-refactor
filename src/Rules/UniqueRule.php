<?php

namespace App\Rules;

use App\Core\AbstractRule;

#[\Attribute]
class UniqueRule extends AbstractRule {
    protected string $message = 'The :field is already in use.';

    public function validate($field): bool {
        // Check if the email already exists in the database
        return !$this->dto->repository->findBy($field, $this->dto->$field);
    }
}
