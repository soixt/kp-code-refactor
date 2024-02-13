<?php

namespace App\Core;

use ReflectionClass;

class Validator {
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
