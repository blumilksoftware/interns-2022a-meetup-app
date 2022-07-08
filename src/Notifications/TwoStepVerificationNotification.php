<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Notifications;

use Blumilk\Meetup\Core\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoStepVerificationNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected User $user,
        protected int $code,
    ) {}

    public function via(): array
    {
        return ["mail"];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->replyTo($this->user->email)
            ->line(
                $this->code,
            );
    }
}
