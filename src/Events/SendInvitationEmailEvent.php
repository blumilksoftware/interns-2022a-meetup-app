<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Events;

use Blumilk\Meetup\Core\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendInvitationEmailEvent
{
    use Dispatchable;
 use InteractsWithSockets;
 use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public User $senderUser,
        public string $receiverEmail,
    ) {}

    /**
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("channel-name");
    }
}
