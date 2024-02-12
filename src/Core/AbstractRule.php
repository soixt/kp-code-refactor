<?php

namespace App\Core\Rules;

use App\Core\Interfaces\RuleInterface;

#[\Attribute]
abstract class AbstractRule implements RuleInterface
{
    protected string $message = 'The :field validation failed.';

    public function getMessage($field): string
    {
        return str_replace(':field', $field, $this->message);
    }

    public function validate($value): bool
    {
        return false;
    }

    public function setMessage ($message):void
    {
        $this->message = $message;
    }
}
