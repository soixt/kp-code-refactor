<?php

namespace App\Services;

class MaxMindService {
    public function checkEmailAndIP(string $email, string $ip): bool {
        return rand(0,1);
    }
}
