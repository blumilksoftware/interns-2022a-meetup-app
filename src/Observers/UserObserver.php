<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Observers;

use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Services\UserRegisterService;

class UserObserver
{
    public function __construct(

    ) {}

    public function creating(User $user): void
    {
    }
}
