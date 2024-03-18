<?php

namespace App\Infrastructure\Validation\Rules;

use App\Infrastructure\Validation\Rules\AbstractRule;
use App\Integration\Services\MaxMindService;

/**
 * MaxMindRule class.
 *
 * This class represents a validation rule for checking registration eligibility using MaxMind service.
 */
#[\Attribute]
class MaxMindRule extends AbstractRule {
    /**
     * The default error message when the registration is not possible due to fraud detection.
     */
    protected string $message = 'The registration is not possible due to fraud detection.';

    /**
     * Validate the field value to determine if the registration is possible using MaxMind service.
     *
     * @param mixed $field The value of the field to validate.
     * @return bool Returns true if the registration is possible, false if it's not due to fraud detection.
     */
    public function validate($field): bool {
        $maxMindService = new MaxMindService;
        // Assuming $data contains email and IP address
        return !$maxMindService->checkEmailAndIP($this->dto->$field, $_SERVER['REMOTE_ADDR']);
    }
}
