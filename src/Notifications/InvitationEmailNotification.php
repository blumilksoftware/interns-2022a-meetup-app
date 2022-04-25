<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Notifications;

use Blumilk\Meetup\Core\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvitationEmailNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected User $senderUser,
        protected string $email,
    ) {}

    public function via(): array
    {
        return ["mail"];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->replyTo($this->email)
            ->view(
                "emails.invitation",
                [
                    "receiver" => $this->email,
                    "sender" => $this->senderUser,
                ],
            )
    ; }
}
