<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Notifications\InvitationEmailNotification;
use Illuminate\Support\Facades\Notification;

class InvitationsService
{
    public function sendInvitation(User $senderUser, string $email): void
    {
        Notification::route("mail", $email)->notify(new InvitationEmailNotification($senderUser, $email));
    }
}
