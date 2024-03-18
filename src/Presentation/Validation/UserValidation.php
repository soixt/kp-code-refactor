<?php

namespace App\Presentation\Validation;

use App\Infrastructure\Validation\AbstractValidation;
use App\Infrastructure\Validation\Rules\EqualRule;
use App\Infrastructure\Validation\Rules\IsNotEmptyRule;
use App\Infrastructure\Validation\Rules\IsValidEmailFormatRule;
use App\Infrastructure\Validation\Rules\MaxMindRule;
use App\Infrastructure\Validation\Rules\MinLengthRule;
use App\Infrastructure\Validation\Rules\UniqueRule;

/**
 * UserValidation class.
 *
 * This validation object is used for validating request data.
 * It defines the properties and validation rules for registering a user.
 */
class UserValidation extends AbstractValidation {
    /**
     * The email address of the user.
     *
     * @var string
     */
    #[IsNotEmptyRule]
    #[IsValidEmailFormatRule]
    #[UniqueRule]
    #[MaxMindRule]
    protected string $email;

    /**
     * The password for the user account.
     *
     * @var string
     */
    #[IsNotEmptyRule]
    #[MinLengthRule(minLength: 8)]
    protected string $password;

    /**
     * The confirmation of the password for the user account.
     *
     * @var string
     */
    #[IsNotEmptyRule]
    #[MinLengthRule(minLength: 8)]
    #[EqualRule('password')]
    protected string $password2;
}
