<?php

declare(strict_types=1);

namespace Tests\Feature;

use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Notifications\InvitationEmailNotification;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class InviteAdminTest extends TestCase
{
    use DatabaseMigrations;

    public function testAdminCanSeeSendInvitationPage(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->get('/invitation')
            ->assertOk();
    }

    public function testAdminCanSendInvitation(): void
    {
        Notification::fake();

        $admin = User::factory()->admin()->create();

        $invitedUser = User::factory([
            'email' => 'invited@example.com',
        ])->make();

        $this->actingAs($admin)
            ->post('/invitation', [
                'email' => $invitedUser->email,
            ])
            ->assertSessionHasNoErrors();

        Notification::assertSentTo($invitedUser, InvitationEmailNotification::class);
    }

    public function testUserCannotSendInvitation(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/invitation')
            ->assertForbidden();
    }
}
