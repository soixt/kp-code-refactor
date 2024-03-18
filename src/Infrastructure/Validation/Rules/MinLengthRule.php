<?php

namespace App\Infrastructure\Validation\Rules;

use App\Infrastructure\Validation\Rules\AbstractRule;

/**
 * MinLengthRule class.
 *
 * This class represents a validation rule for checking the minimum length of a field value.
 */
#[\Attribute]
class MinLengthRule extends AbstractRule {
    /**
     * The minimum length required for the field value.
     */
    protected int $minLength;
    
    /**
     * Create a new MinLengthRule instance.
     *
     * @param mixed $dto The data transfer object (DTO) being validated.
     * @param int $minLength The minimum length required for the field value.
     */
    public function __construct($dto, int $minLength) {
        parent::__construct($dto);
        $this->minLength = $minLength;
        $this->message = "The :field must be at least {$minLength} characters long.";
    }
    
    /**
     * Validate the field value to ensure it meets the minimum length requirement.
     *
     * @param mixed $field The value of the field to validate.
     * @return bool Returns true if the field value meets the minimum length requirement, false otherwise.
     */
    public function validate($field): bool {
        return strlen($this->dto->$field) >= $this->minLength;
    }
}
