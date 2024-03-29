<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services\Authentication;

use Blumilk\Meetup\Core\Exceptions\PasswordIsTheSameAsOldException;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Contracts\Hashing\Hasher;

class ChangePasswordService
{
    public function __construct(
        protected PasswordBrokerManager $password,
        protected Hasher $hash,
    ) {}

    /**
     * @throws PasswordIsTheSameAsOldException
     */
    public function validatePassword(string $password, string $databasePassword): void
    {
        if ($this->hash->check($password, $databasePassword)) {
            throw new PasswordIsTheSameAsOldException();
        }
    }

    public function hashPassword(string $password): string
    {
        return $this->hash->make($password);
    }
}
