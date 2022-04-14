<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\NewsletterSubscriber;

class NewsletterService
{
    public function isSubscriber(NewsletterSubscriber $subscriber): string
    {
        if ($subscriber->subscription_state) {
            return "You are already subscriber. Would you like to change your preferences?";
        }
        $subscriber->subscription_state = true;
        $subscriber->saveOrFail();

        return "Thank you for subscribing to our newsletter. What would you like to subscribe?";
    }

    public function preference(NewsletterSubscriber $subscriber, array $preferences): string
    {
        $subscriber->preferences()->delete();

        foreach ($preferences as $type) {
            $subscriber->preferences()->firstOrCreate([
                "preference" => $type,
            ]);
        }

        return "You are successfully subscribed";
    }

    public function unsubscribe(NewsletterSubscriber $subscriber): string
    {
        $subscriber->preferences()->delete();
        $subscriber->subscription_state = false;
        $subscriber->saveOrFail();

        return "You have delete your subscription";
    }
}
