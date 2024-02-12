<?php

namespace App\Rules;

use App\Core\Rules\AbstractRule;

class IsNotEmptyRule extends AbstractRule {
    public function validate ($value): bool {
        return !empty($value);
    }
}