<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\NewsletterSubscriber;
use Illuminate\Http\Response;

class NewsletterService
{
    public function isSubscriber(NewsletterSubscriber $subscriber): Response
    {
        if ($subscriber->getAttribute("status") === 1) {
            return response("You are already subscriber. Would you like to change your preferences?");
        }
        $subscriber->status = 1;
        $subscriber->saveOrFail();

        return response("Thank you for subscribing to our newsletter. What would you like to subscribe?");
    }

    public function preference(NewsletterSubscriber $subscriber, array $preferences): Response
    {
        $subscriber->preferences()->delete();

        foreach ($preferences as $type) {
            $subscriber->preferences()->firstOrCreate([
                "preference" => $type,
            ]);
        }

        return response("You are successfully subscribed");
    }

    public function unsubscribe(NewsletterSubscriber $subscriber): Response
    {
        $subscriber->preferences()->delete();
        $subscriber->status = false;
        $subscriber->saveOrFail();

        return response("You have delete your subscription");
    }
}
