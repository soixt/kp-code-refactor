<?php

namespace App\Core\Enums;

/**
 * UserLogAction enum.
 *
 * This enum represents the possible actions for user logs.
 */
enum UserLogAction {
    case REGISTER;
    case LOGIN;
    case UPDATE;
    
    /**
     * Get label method.
     *
     * Returns the label corresponding to each user log action.
     *
     * @return string The label for the user log action.
     */
    public function getLabel(): string {
        return match ($this) {
            self::REGISTER => "Register",
            self::LOGIN => "Login",
            self::UPDATE => "Update",
        };
    } 
}
