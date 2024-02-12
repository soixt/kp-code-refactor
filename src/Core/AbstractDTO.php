<?php

namespace App\Core;

abstract class AbstractDTO {
    public function __construct(array $data) {
        foreach ($data as $property => $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }

    public function __get(string $name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \RuntimeException("Property $name does not exist in " . static::class);
    }

    public function __set(string $name, $value) {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            throw new \RuntimeException("Property $name does not exist in " . static::class);
        }
    }
}