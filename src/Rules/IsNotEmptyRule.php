<?php

namespace App\Rules;

use App\Core\Rules\AbstractRule;

class IsNotEmptyRule extends AbstractRule {
    protected string $message = 'The :field is empty.';
    public function validate ($value): bool {
        return !empty($value);
    }
}