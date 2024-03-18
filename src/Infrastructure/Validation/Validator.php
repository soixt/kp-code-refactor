<?php

namespace App\Infrastructure\Validation;

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
     * @param object $validation The data transfer object (validation) to validate.
     * @return mixed An associative array containing validation errors, if any.
     */
    public function validate(object $validation): mixed {
        try {
            $errors = [];
            $reflectionClass = new ReflectionClass($validation::class);
            $properties = $reflectionClass->getProperties();

            foreach ($properties as $property) {
                $propertyName = $property->getName();
                $attributes = $property->getAttributes();

                foreach ($attributes as $attribute) {
                    $attributeClass = $attribute->getName();
                    $attributeInstance = new $attributeClass($validation, ...$attribute->getArguments());

                    // Perform validation based on attribute instance
                    if (!$attributeInstance->validate($propertyName)) {
                        $errors[$propertyName][] = $attributeInstance->getMessage($propertyName);
                    }
                }
            }

            if (!empty($errors)) {
                response([
                    'success' => false,
                    'errors' => $errors
                ]);
            }

            return null;
        } catch (\Throwable $th) {
            throw new \Exception("Validation error.");
        }
    }
}
