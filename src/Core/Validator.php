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
                $attributeName = $attribute->getName();
                $attributeInstance = $attribute->newInstance();

                // Perform validation based on attribute instance
                if (!$attributeInstance->validate($dto->$propertyName)) {
                    $errors[$propertyName][] = $attributeInstance->message();
                }
            }
        }

        return $errors;
    }
}
