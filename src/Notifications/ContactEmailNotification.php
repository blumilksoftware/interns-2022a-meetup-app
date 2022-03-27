<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactEmailNotification extends Notification
{
    use Queueable;

    public function via(): array
    {
        return ["mail"];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject("Contact Email: " . $notifiable->subject)
            ->view(
                "emails.contact",
                [
                    "contact" => $notifiable,
                ],
            );
    }
}
