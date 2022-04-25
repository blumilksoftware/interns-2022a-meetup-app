<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Providers;

use Blumilk\Meetup\Core\Events\SendInvitationEmailEvent;
use Blumilk\Meetup\Core\Listeners\SendInvitationEmailListener;
use Blumilk\Meetup\Core\Models\Contact;
use Blumilk\Meetup\Core\Models\Meetup;
use Blumilk\Meetup\Core\Models\NewsletterSubscriber;
use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Observers\ContactObserver;
use Blumilk\Meetup\Core\Observers\MeetupObserver;
use Blumilk\Meetup\Core\Observers\NewsletterSubscriberObserver;
use Blumilk\Meetup\Core\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SendInvitationEmailEvent::class => [SendInvitationEmailListener::class],
    ];

    public function boot(): void
    {
        User::observe(UserObserver::class);
        Contact::observe(ContactObserver::class);
        Meetup::observe(MeetupObserver::class);
        NewsletterSubscriber::observe(NewsletterSubscriberObserver::class);
    }
}
