<?php

namespace App\Infrastructure\Validation;

use App\Infrastructure\Validation\Validator;

class AbstractValidation {
    public function __construct(protected Validator $validator) {
        $this->validate($_REQUEST);
    }

    public function validate (array $fields) {
        foreach ($fields as $property => $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }

        $this->validator->validate($this);

        return $this;
    }

    /**
     * Magic getter method.
     *
     * Retrieves the value of a property from the DTO.
     *
     * @param string $name The name of the property to retrieve.
     * @return mixed The value of the property.
     * @throws \RuntimeException if the property does not exist in the DTO.
     */
    public function __get(string $name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \RuntimeException("Property $name does not exist in " . static::class);
    }
}