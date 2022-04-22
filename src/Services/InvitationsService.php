<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\User;

class InvitationsService
{
    public function existed(string $email): bool
    {
        $user = User::query()->where("email", $email)->first();

        if ($user){
            return true;
        }

        return false;
    }

    public function invite(string $email): void
    {
        event();
    }
}
