<?php

namespace App\Rules;

use App\Core\Rules\AbstractRule;

class EqualRule extends AbstractRule {
    public function __construct(protected string $valueToCompare) {
        $this->message = "The :field must be equal to '{$valueToCompare}'.";
    }

    public function validate($value): bool {
        return $value === $this->valueToCompare;
    }
}
