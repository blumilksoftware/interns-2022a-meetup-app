<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Policies;

use Blumilk\Meetup\Core\Models\Meetup;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeetupPolicy
{
    use HandlesAuthorization;

    public function change(User $user, Meetup $meetup)
    {
        return $user->id === $meetup->user_id;
    }
}
