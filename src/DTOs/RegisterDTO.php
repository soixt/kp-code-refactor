<?php

namespace App\DTOs;

use App\Core\AbstractDTO;
use App\Core\Interfaces\RepositoryInterface;
use App\Repositories\UserRepository;
use App\Rules\EqualRule;
use App\Rules\IsNotEmptyRule;
use App\Rules\IsValidEmailFormatRule;
use App\Rules\MaxMindRule;
use App\Rules\MinLengthRule;
use App\Rules\UniqueRule;

/**
 * RegisterDTO class.
 *
 * This data transfer object (DTO) represents the data structure for registering a user.
 * It defines the properties and validation rules for registering a user.
 */
class RegisterDTO extends AbstractDTO {
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

    /**
     * The repository for user-related database operations.
     *
     * @var RepositoryInterface
     */
    protected RepositoryInterface $repository;

    /**
     * Constructs a new RegisterDTO object.
     *
     * @param array $data The data to populate the DTO properties.
     */
    public function __construct(array $data) {
        parent::__construct($data);
        $this->repository = new UserRepository();
    }
}
