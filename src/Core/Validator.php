<?php

namespace App\Core;

use ReflectionClass;

/**
 * Validator class.
 *
 * This class is responsible for validating data transfer objects (DTOs) based on defined validation rules.
 */
class Validator {
    /**
     * Validate a data transfer object (DTO).
     *
     * @param object $dto The data transfer object (DTO) to validate.
     * @return array An associative array containing validation errors, if any.
     */
    public function validate(object $dto): array {
        $errors = [];
        $reflectionClass = new ReflectionClass($dto::class);
        $properties = $reflectionClass->getProperties();

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $attributes = $property->getAttributes();

            foreach ($attributes as $attribute) {
                $attributeClass = $attribute->getName();
                $attributeInstance = new $attributeClass($dto, ...$attribute->getArguments());

                // Perform validation based on attribute instance
                if (!$attributeInstance->validate($propertyName)) {
                    $errors[$propertyName][] = $attributeInstance->getMessage($propertyName);
                }
            }
        }

        return $errors;
    }
}
