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

class RegisterDTO extends AbstractDTO {
    #[IsNotEmptyRule]
    #[IsValidEmailFormatRule]
    #[UniqueRule]
    #[MaxMindRule]
    protected string $email;

    #[IsNotEmptyRule]
    #[MinLengthRule(minLength: 8)]
    protected string $password;

    #[IsNotEmptyRule]
    #[MinLengthRule(minLength: 8)]
    #[EqualRule('password')]
    protected string $password2;

    protected RepositoryInterface $repository;

    public function __construct(array $data) {
        parent::__construct($data);
        $this->repository = new UserRepository();
    }
}