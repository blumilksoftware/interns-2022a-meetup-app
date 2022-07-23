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
        return [Channels::MAIL];
    }

    public function toMail(): MailMessage
    {
        $detailsUrl = route("news");

        return $this->buildMessage($detailsUrl);
    }

    protected function buildMessage(string $url): MailMessage
    {
        $title = $this->news->name;
        $email = $this->subscriber->email;

        return (new MailMessage())
            ->replyTo($email)
            ->subject("New news has been created")
            ->markdown(
                "emails.newsletters.news",
                [
                    "email" => $email,
                    "title" => $title,
                    "url" => $url,
                ],
            );
    }
}
