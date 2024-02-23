<?php

namespace App\Core\Interfaces;

/**
 * RuleInterface
 *
 * This interface defines the contract for rule classes used in validation.
 * Rule classes implement a validate method to check if a value meets a certain condition.
 */
interface RuleInterface {
    
    /**
     * Validate method.
     *
     * Validates a value against a specific rule.
     *
     * @param mixed $value The value to validate.
     * @return bool True if the value passes the validation rule, false otherwise.
     */
    public function validate($value): bool;
}
