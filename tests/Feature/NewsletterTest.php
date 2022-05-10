<?php

declare(strict_types=1);

namespace Tests\Feature;

use Blumilk\Meetup\Core\Models\NewsletterSubscriber;
use Blumilk\Meetup\Core\Notifications\NewsletterNotification;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class NewsletterTest extends TestCase
{
    use DatabaseMigrations;

    public function testGuestCanSeeNewsletterPage(): void
    {
        $this->get("/newsletter")
            ->assertOk();
    }

    public function testUserCanSubscribeNewsletter(): void
    {
        Notification::fake();

        $this->post("/newsletter/subscribe", [
            "email" => "subscriber@example.com",
        ])
            ->assertSessionHasNoErrors()
            ->assertOk();

        $subscriber = NewsletterSubscriber::query()
            ->where("email", "subscriber@example.com")
            ->first();

        Notification::assertSentTo($subscriber, NewsletterNotification::class);
    }
}
