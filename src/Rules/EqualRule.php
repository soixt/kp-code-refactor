<?php

namespace App\Rules;

use App\Core\AbstractRule;

/**
 * EqualRule class.
 *
 * This class represents a validation rule for ensuring that the value of a field
 * is equal to the value of another field in the DTO.
 */
#[\Attribute]
class EqualRule extends AbstractRule {
    /**
     * Create a new EqualRule instance.
     *
     * @param object $dto The data transfer object (DTO) containing the field values.
     * @param string $fieldToCompare The name of the field to compare against.
     */
    public function __construct($dto, protected string $fieldToCompare) {
        parent::__construct($dto);
        $this->message = "The :field must be equal to '{$fieldToCompare}'.";
    }

    /**
     * Validate the field value against the value of the specified field in the DTO.
     *
     * @param mixed $field The value of the field to validate.
     * @return bool Returns true if the field value is equal to the value of the specified field, false otherwise.
     */
    public function validate($field): bool {
        return $this->dto->$field === $this->dto->{$this->fieldToCompare};
    }
}
