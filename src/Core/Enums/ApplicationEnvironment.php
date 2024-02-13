<?php

namespace App\Core\Enums;

enum ApplicationEnvironment {
    case LOCAL;
    case DEV;
    case PROD;
    case STAGING;
    
    public function getLabel(): string {
        return match ($this) {
            self::LOCAL => "Local Environment",
            self::DEV => "Development Environment",
            self::PROD => "Production Environment",
            self::STAGING => "Staging Environment",
        };
    } 
}