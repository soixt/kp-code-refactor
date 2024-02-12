<?php

namespace App\Core\Rules;

use App\Core\Interfaces\RuleInterface;

#[\Attribute]
abstract class AbstractRule implements RuleInterface
{
    protected string $defaultMessage = 'The validation failed.';

    public function __construct() {

    }

    public function message($message = ''): string
    {
        return $message ?? $this->defaultMessage;
    }

    public function validate($value): bool
    {
        return false;
    }
}
