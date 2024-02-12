<?php

namespace App\Rules;

use App\Core\Rules\AbstractRule;

class MinLengthRule extends AbstractRule {
    protected int $minLength;
    
    public function __construct(int $minLength) {
        $this->minLength = $minLength;
        $this->message = "The :field must be at least {$minLength} characters long.";
    }
    
    public function validate($value): bool {
        return strlen($value) >= $this->minLength;
    }
}
