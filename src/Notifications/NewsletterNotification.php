<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Notifications;

use Blumilk\Meetup\Core\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewsletterNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected NewsletterSubscriber $subscriber,
    ) {}

    public function via(): array
    {
        return ["mail"];
    }

    public function toMail(): MailMessage
    {
        $url = route("home");

        return $this->buildMessage($url);
    }

    protected function buildMessage($url): MailMessage
    {
        $email = $this->subscriber->email;

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
