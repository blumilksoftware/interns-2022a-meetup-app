<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Illuminate\Contracts\Hashing\Hasher;

class UserRegisterService
{
    public function __construct(
        protected Hasher $hasher,
    ) {}

    public function register(string $password): string
    {
        if (!$this->hasher->info($password)["algo"]) {
            $password = $this->hasher->make($password);
        }

        return $password;
    }
}
