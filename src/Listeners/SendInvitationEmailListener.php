<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Listeners;

use Blumilk\Meetup\Core\Events\SendInvitationEmailEvent;
use Blumilk\Meetup\Core\Notifications\InvitationEmailNotification;

class SendInvitationEmailListener
{
    public function handle(SendInvitationEmailEvent $event): void
    {
        $event->senderUser->notify(new InvitationEmailNotification($event->senderUser, $event->receiverEmail));
    }
}
