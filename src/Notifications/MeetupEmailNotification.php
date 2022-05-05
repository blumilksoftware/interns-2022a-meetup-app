<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Notifications;

use Blumilk\Meetup\Core\Models\Meetup;
use Blumilk\Meetup\Core\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MeetupEmailNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected Meetup $meetup,
        protected NewsletterSubscriber $subscriber,
    ) {}

    public function via(): array
    {
        return ["mail"];
    }

    public function toMail(): MailMessage
    {
        $detailsUrl = route("meetups");

        return $this->buildMessage($detailsUrl);
    }

    protected function buildMessage(string $url): MailMessage
    {
        $title = $this->meetup->title;
        $email = $this->subscriber->email;

        return (new MailMessage())
            ->replyTo($email)
            ->subject("New meetup has been created")
            ->markdown(
                "emails.newsletters.meetups",
                [
                    "url" => $url,
                    "email" => $email,
                    "title" => $title,
                ],
            );
    }
}
