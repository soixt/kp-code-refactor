<?php

namespace App\Rules;

use App\Core\AbstractRule;

#[\Attribute]
class EqualRule extends AbstractRule {
    public function __construct($dto, protected string $fieldToCompare) {
        parent::__construct($dto);
        $this->message = "The :field must be equal to '{$fieldToCompare}'.";
    }

    public function validate($field): bool {
        return $this->dto->$field === $this->dto->{$this->fieldToCompare};
    }
}
