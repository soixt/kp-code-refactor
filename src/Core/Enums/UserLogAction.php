<?php

namespace App\Core\Enums;

enum UserLogAction {
    case REGISTER;
    case LOGIN;
    case UPDATE;
    
    public function getLabel(): string {
        return match ($this) {
            self::REGISTER => "Register",
            self::LOGIN => "Login",
            self::UPDATE => "Update",
        };
    } 
}