<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Observers;

use Blumilk\Meetup\Core\Models\NewsletterSubscriber;
use Blumilk\Meetup\Core\Notifications\NewsletterNotification;

class NewsletterSubscriberObserver
{
    public function created(NewsletterSubscriber $subscriber): void
    {
        $subscriber->notify(new NewsletterNotification($subscriber));
    }
}
