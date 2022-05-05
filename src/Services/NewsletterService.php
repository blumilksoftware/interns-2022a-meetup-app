<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\NewsletterSubscriber;

class NewsletterService
{
    public function subscribe(NewsletterSubscriber $subscriber): void
    {
        if (!$subscriber->subscribed) {
            $subscriber->subscribed = true;
            $subscriber->saveOrFail();
        }
    }

    public function preference(NewsletterSubscriber $subscriber, array $preferences): void
    {
        $subscriber->preferences()->delete();

        foreach ($preferences as $type) {
            $subscriber->preferences()->firstOrCreate([
                "preference" => $type,
            ]);
        }
    }

    public function unsubscribe(NewsletterSubscriber $subscriber): void
    {
        $subscriber->preferences()->delete();
        $subscriber->deleteOrFail();
    }
}
