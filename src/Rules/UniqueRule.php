<?php

namespace App\Rules;

use App\Core\Interfaces\RepositoryInterface;
use App\Core\Rules\AbstractRule;

class UniqueRule extends AbstractRule {
    protected string $message = 'The :field is already in use.';
    public function __construct(protected RepositoryInterface $repository, protected $value) {}

    public function validate($field): bool {
        // Check if the email already exists in the database
        return !$this->repository->findBy($field, $this->value);
    }
}
