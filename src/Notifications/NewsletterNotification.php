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
        return $this->buildMessage();
    }

    protected function buildMessage(): MailMessage
    {
        $email = $this->subscriber->email;

        return (new MailMessage())
            ->replyTo($email)
            ->subject("Subscribe newsletter")
            ->markdown(
                "emails.newsletter",
                [
                    "email" => $email,
                ],
            )
    ; }
}
