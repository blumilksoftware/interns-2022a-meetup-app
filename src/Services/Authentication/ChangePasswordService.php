<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services\Authentication;

use Blumilk\Meetup\Core\Exceptions\PasswordDoesMatchException;
use Blumilk\Meetup\Core\Exceptions\PasswordDoesNotMatchException;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Contracts\Hashing\Hasher;

class ChangePasswordService
{
    public function __construct(
        protected PasswordBrokerManager $password,
        protected Hasher $hash,
    ) {}

    /**
     * @throws PasswordDoesNotMatchException
     */
    public function currentPassword(string $password, string $databasePassword): void
    {
        if (!$this->hash->check($password, $databasePassword)) {
            throw new PasswordDoesNotMatchException();
        }
    }

    /**
     * @throws PasswordDoesMatchException
     */
    public function validatePassword(string $password, string $databasePassword): void
    {
        if ($this->hash->check($password, $databasePassword)) {
            throw new PasswordDoesMatchException();
        }
    }
}
