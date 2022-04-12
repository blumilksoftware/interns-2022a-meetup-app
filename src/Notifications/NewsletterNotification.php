<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewsletterNotification extends Notification
{
    use Queueable;

    public function via(): array
    {
        return ["mail"];
    }

    public function toMail($notifiable): MailMessage
    {
        $email = $notifiable->email;
        $url = route("home");

        return (new MailMessage())
            ->replyTo($email)
            ->greeting(__("Hi :user", [
                "user" => $email,
            ]))
            ->subject("Subscribe newsletter")
            ->line("Thank you for subscribing to our newsletter")
            ->action(__("Click here if you want to go to our page"), $url);
    }
}
