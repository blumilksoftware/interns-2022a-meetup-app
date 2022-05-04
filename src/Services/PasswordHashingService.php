<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

class PasswordHashingService
{
    public function __construct(
        protected Hasher $hasher,
    ) {}

    public function hash(User $user): void
    {
        if (!$this->hasher->info($user->password)["algo"]) {
            $user->password = $this->hasher->make($user->password);
        }
    }
}
