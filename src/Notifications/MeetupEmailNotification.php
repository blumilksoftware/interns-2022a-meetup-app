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
        $title = $this->meetup->title;
        $email = $this->subscriber->email;
        $detailsUrl = route("meetups");

        return (new MailMessage())
            ->replyTo($email)
            ->greeting(__("Hi :user", [
                "user" => $email,
            ]))
            ->line("New meetup has been created")
            ->line(__(":title ", [
                "title" => $title,
            ]))
            ->action(__("Click here for details"), $detailsUrl);
    }
}