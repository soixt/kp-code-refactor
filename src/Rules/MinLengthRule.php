<?php

namespace App\Rules;

use App\Core\AbstractRule;

#[\Attribute]
class MinLengthRule extends AbstractRule {
    protected int $minLength;
    
    public function __construct($dto, int $minLength) {
        parent::__construct($dto);
        $this->minLength = $minLength;
        $this->message = "The :field must be at least {$minLength} characters long.";
    }
    
    public function validate($field): bool {
        return strlen($this->dto->$field) >= $this->minLength;
    }
}
