<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\NewsletterSubscriber;

class NewsletterService
{
    public function checkIfSubriber(NewsletterSubscriber $subscriber)
    {
        if ($subscriber->getAttribute("status") === true) {
            return response("You are already subscriber.");
        }
        $subscriber->status = true;
        $subscriber->saveOrFail();
        return response("Thank you for subscribing to our newsletter.");
    }
}
