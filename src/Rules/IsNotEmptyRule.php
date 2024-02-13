<?php

namespace App\Rules;

use App\Core\AbstractRule;

#[\Attribute]
class IsNotEmptyRule extends AbstractRule {
    protected string $message = 'The :field is empty.';
    public function validate ($field): bool {
        return $this->dto->$field != "";
    }
}