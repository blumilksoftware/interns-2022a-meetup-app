<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Observers;

use Blumilk\Meetup\Core\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

class UserObserver
{
    public function __construct(
        public Hasher $hasher,
    ) {}

    public function creating(User $user): void
    {
        $user->password = $this->hasher->make($user->password);
    }
}
