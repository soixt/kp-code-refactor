<?php

namespace App\Core\Interfaces;

interface RuleInterface {
    public function validate ($value): bool;
}