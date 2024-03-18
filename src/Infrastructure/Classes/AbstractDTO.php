<?php

namespace App\Infrastructure\Classes;

/**
 * AbstractDTO class.
 *
 * This abstract class serves as a base for Data Transfer Objects (DTOs).
 * It provides basic functionality for setting and getting properties from the DTO.
 */
abstract class AbstractDTO implements \JsonSerializable {
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

    public function jsonSerialize(): array {
        return get_object_vars($this);
    }
}
