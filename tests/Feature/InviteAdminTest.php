<?php

declare(strict_types=1);

namespace Tests\Feature;

use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Notifications\InvitationEmailNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class InviteAdminTest extends TestCase
{
    use RefreshDatabase;

    public User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(["name" => "admin"]);
        $this->admin = User::factory()->create()->assignRole("admin");
    }

    public function testAdminCanSeeSendInvitationPage(): void
    {
        $this->actingAs($this->admin)
            ->get("/invitation")
            ->assertOk();
    }

    public function testAdminCanSendInvitation(): void
    {
        Notification::fake();

        $invitedUser = User::factory([
            "email" => "invited@example.com",
        ])->make();

        $this->actingAs($this->admin)
            ->post("/invitation", [
                "email" => $invitedUser->email,
            ])
            ->assertSessionHasNoErrors();

        Notification::assertSentTo($invitedUser, InvitationEmailNotification::class);
    }

    public function testUserCannotSendInvitation(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get("/invitation")
            ->assertLocation("/");
    }
}
