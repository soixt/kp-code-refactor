<?php

namespace App\Rules;

use App\Core\Rules\AbstractRule;
use App\Services\MaxMindService;

class MaxMindRule extends AbstractRule {
    protected string $message = 'The registration is not possible due to fraud detection.';
    public function __construct(protected MaxMindService $maxMindService) {}

    public function validate($data): bool {
        // Assuming $data contains email and IP address
        return !$this->maxMindService->checkEmailAndIP('', '');
    }
}
