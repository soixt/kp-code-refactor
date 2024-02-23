<?php

namespace App\Rules;

use App\Core\AbstractRule;

/**
 * UniqueRule class.
 *
 * This class represents a validation rule for ensuring the uniqueness of a field value.
 */
#[\Attribute]
class UniqueRule extends AbstractRule {
    /**
     * The default error message for when the field value is not unique.
     */
    protected string $message = 'The :field is already in use.';

    /**
     * Validate the uniqueness of the field value.
     *
     * @param mixed $field The value of the field to validate.
     * @return bool Returns true if the field value is unique, false otherwise.
     */
    public function validate($field): bool {
        // Check if the field value already exists in the database
        return !$this->dto->repository->findBy($field, $this->dto->$field);
    }
}
