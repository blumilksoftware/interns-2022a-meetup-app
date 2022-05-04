<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Observers;

use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Services\PasswordHashingService;

class UserObserver
{
    public function __construct(
        protected PasswordHashingService $service,
    ) {}

    public function creating(User $user): void
    {
        $this->service->hash($user);
    }
}
