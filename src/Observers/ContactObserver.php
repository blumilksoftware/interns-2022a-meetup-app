<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Observers;

use Blumilk\Meetup\Core\Models\Contact;
use Blumilk\Meetup\Core\Notifications\ContactEmailNotification;

class ContactObserver
{
    public function created(Contact $contact): void
    {
        $contact->notify(new ContactEmailNotification());
    }
}
