<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\User;

class UserProfileService
{
    public function create(User $user): void
    {
        $user->profile()->create();
    }

    public function update(User $user, array $userData, array $profileData): void
    {
        $user->update($userData);
        $user->profile()->update($profileData);
    }
}
