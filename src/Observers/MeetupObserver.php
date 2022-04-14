<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Observers;

use Blumilk\Meetup\Core\Enums\AvailableNewsletter;
use Blumilk\Meetup\Core\Models\Meetup;
use Blumilk\Meetup\Core\Models\NewsletterSubscriber;
use Blumilk\Meetup\Core\Notifications\MeetupEmailNotification;
use Illuminate\Database\Eloquent\Collection;

class MeetupObserver
{
    public function created(Meetup $meetup): void
    {
        $this->getSubscribersForNotifications()
            ->each(fn($subscriber) => $subscriber->notify(new MeetupEmailNotification($meetup, $subscriber)));
    }

    protected function getSubscribersForNotifications(): Collection
    {
        return NewsletterSubscriber::query()
            ->whereRelation("preferences", "preference", AvailableNewsletter::MEETUPS->value)
            ->get();
    }
}
