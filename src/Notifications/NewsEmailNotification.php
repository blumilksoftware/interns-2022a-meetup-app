<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Notifications;

use Blumilk\Meetup\Core\Models\News;
use Blumilk\Meetup\Core\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewsEmailNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected News $news,
        protected NewsletterSubscriber $subscriber,
    ) {}

    public function via(): array
    {
        return ["mail"];
    }

    public function toMail(): MailMessage
    {
        $title = $this->news->name;
        $email = $this->subscriber->email;
        $detailsUrl = route("meetups");

        return (new MailMessage())
            ->replyTo($email)
            ->greeting(__("Hi :user", [
                "user" => $email,
            ]))
            ->subject("New news has been created")
            ->line("New news has been created")
            ->line(__(":title ", [
                "title" => $title,
            ]))
            ->action(__("Click here for details"), $detailsUrl);
    }
}
