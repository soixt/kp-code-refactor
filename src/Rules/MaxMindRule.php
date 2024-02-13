<?php

namespace App\Rules;

use App\Core\AbstractRule;
use App\Services\MaxMindService;

#[\Attribute]
class MaxMindRule extends AbstractRule {
    protected string $message = 'The registration is not possible due to fraud detection.';

    public function validate($field): bool {
        $maxMindService = new MaxMindService;
        // Assuming $data contains email and IP address
        return !$maxMindService->checkEmailAndIP($this->dto->$field, $_SERVER['REMOTE_ADDR']);
    }
}