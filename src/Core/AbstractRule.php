<?php

namespace App\Core;

use App\Core\Interfaces\RuleInterface;

#[\Attribute]
abstract class AbstractRule implements RuleInterface
{
    protected string $message = 'The :field validation failed.';
    public function __construct(protected AbstractDTO $dto) {}

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
