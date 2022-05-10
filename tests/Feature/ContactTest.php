<?php

declare(strict_types=1);

namespace Tests\Feature;

use Blumilk\Meetup\Core\Models\Contact;
use Blumilk\Meetup\Core\Notifications\ContactEmailNotification;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserCanSeeContactPage(): void
    {
        $this->get("/contact")
            ->assertOk();
    }

    public function testUserCanSendContactForm(): void
    {
        Notification::fake();

        $this->post("/contact", [
            "name" => "John",
            "email" => "john.doe@example.com",
            "subject" => "Test subject",
            "message" => "Test message",
        ])
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas("contacts", [
            "name" => "John",
            "email" => "john.doe@example.com",
            "subject" => "Test subject",
            "message" => "Test message",
        ]);

        $contact = Contact::query()->first();

        Notification::assertSentTo([$contact], ContactEmailNotification::class);
    }

    public function testContactFormDataIsRequired(): void
    {
        $this->post("/contact")
            ->assertInvalid([
                "name",
                "email",
                "subject",
                "message",
            ]);
    }
}
