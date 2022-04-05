<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Observers;

use Blumilk\Meetup\Core\Enums\AvailableNewsletter;
use Blumilk\Meetup\Core\Models\News;
use Blumilk\Meetup\Core\Models\NewsletterSubscriber;
use Blumilk\Meetup\Core\Notifications\NewsEmailNotification;
use Illuminate\Database\Eloquent\Collection;

class NewsObserver
{
    public function __construct() {}

    public function created(News $news): void
    {
        foreach ($this->getSubscribersForNotifications() as $subscriber) {
            $subscriber->notify(new NewsEmailNotification($news, $subscriber));
        }
    }

    protected function getSubscribersForNotifications(): Collection
    {
        return NewsletterSubscriber::query()
            ->whereRelation("preferences", "preference", AvailableNewsletter::NEWS->value)
            ->get();
    }
}
