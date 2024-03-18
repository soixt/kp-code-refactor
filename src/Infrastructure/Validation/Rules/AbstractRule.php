<?php

namespace App\Infrastructure\Validation\Rules;

use App\Infrastructure\Validation\Rules\RuleInterface;
use App\Infrastructure\Validation\AbstractValidation;

/**
 * AbstractRule class.
 *
 * This abstract class serves as a base for rule classes used for validation.
 */
#[\Attribute]
abstract class AbstractRule implements RuleInterface
{
    /** @var string The default validation message template. */
    protected string $message = 'The :field validation failed.';

    /**
     * Constructor.
     *
     * Initializes the rule with the provided DTO.
     *
     * @param AbstractValidation $dto The DTO instance to validate.
     */
    public function __construct(protected AbstractValidation $dto) {}

    /**
     * Get message method.
     *
     * Returns the validation message for the rule.
     *
     * @param string $field The name of the field being validated.
     * @return string The formatted validation message.
     */
    public function getMessage($field): string
    {
        return str_replace(':field', $field, $this->message);
    }

    /**
     * Validate method.
     *
     * Validates a value against the rule.
     *
     * @param mixed $value The value to validate.
     * @return bool True if the value passes validation, false otherwise.
     */
    public function validate($value): bool
    {
        return false; // Placeholder implementation, should be overridden in concrete rule classes
    }

    /**
     * Set message method.
     *
     * Sets a custom validation message for the rule.
     *
     * @param string $message The custom validation message.
     * @return void
     */
    public function setMessage ($message):void
    {
        $this->message = $message;
    }
}
