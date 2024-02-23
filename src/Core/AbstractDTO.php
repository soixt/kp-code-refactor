<?php

namespace App\Core;

/**
 * AbstractDTO class.
 *
 * This abstract class serves as a base for Data Transfer Objects (DTOs).
 * It provides basic functionality for setting and getting properties from the DTO.
 */
abstract class AbstractDTO {
    /**
     * Constructor.
     *
     * Initializes the DTO with the provided data.
     *
     * @param array $data An associative array containing data to populate the DTO properties.
     */
    public function __construct(array $data) {
        foreach ($data as $property => $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
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

    /**
     * Magic setter method.
     *
     * Sets the value of a property in the DTO.
     *
     * @param string $name The name of the property to set.
     * @param mixed $value The value to set for the property.
     * @throws \RuntimeException if the property does not exist in the DTO.
     */
    public function __set(string $name, $value) {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            throw new \RuntimeException("Property $name does not exist in " . static::class);
        }
    }
}
