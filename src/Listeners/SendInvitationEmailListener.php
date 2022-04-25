<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Listeners;

use Blumilk\Meetup\Core\Events\SendInvitationEmailEvent;
use Blumilk\Meetup\Core\Notifications\InvitationEmailNotification;

class SendInvitationEmailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     */
    public function handle(SendInvitationEmailEvent $event): void
    {
        $event->senderUser->notify( new InvitationEmailNotification($event->senderUser, $event->receiverEmail));
    }
}
