<?php

namespace App\Infrastructure\Validation\Rules;

use App\Infrastructure\Validation\Rules\AbstractRule;

/**
 * IsNotEmptyRule class.
 *
 * This class represents a validation rule for ensuring that a field is not empty.
 */
#[\Attribute]
class IsNotEmptyRule extends AbstractRule {
    /**
     * The default error message for when the field is empty.
     */
    protected string $message = 'The :field is empty.';

    /**
     * Validate the field value to ensure it is not empty.
     *
     * @param mixed $field The value of the field to validate.
     * @return bool Returns true if the field is not empty, false otherwise.
     */
    public function validate ($field): bool {
        return $this->dto->$field != "";
    }
}
