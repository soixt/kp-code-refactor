<?php

namespace App\Core\Enums;

/**
 * ApplicationEnvironment enum.
 *
 * This enum represents the possible environments of the application.
 */
enum ApplicationEnvironment {
    case LOCAL;
    case DEV;
    case PROD;
    case STAGING;
    
    /**
     * Get label method.
     *
     * Returns the label corresponding to each environment.
     *
     * @return string The label for the environment.
     */
    public function getLabel(): string {
        return match ($this) {
            self::LOCAL => "Local Environment",
            self::DEV => "Development Environment",
            self::PROD => "Production Environment",
            self::STAGING => "Staging Environment",
        };
    } 
}
