<?php

declare(strict_types=1);

namespace Tests\Feature;

use Blumilk\Meetup\Core\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserCanEditProfile(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route("users.edit", $user))
            ->assertOk();

        $this->actingAs($user)
            ->put(route("users.update", $user), [
                "name" => "John Doe",
                "email" => "john.doe@example.com",
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas("users", [
            "name" => "John Doe",
            "email" => "john.doe@example.com",
        ]);
    }

    public function testUserCannotEditAnotherUserProfile(): void
    {
        $user = User::factory()->create();

        $unauthorizedUser = User::factory()->create();

        $this->actingAs($user)
            ->get(route("users.edit", $unauthorizedUser))
            ->assertForbidden();

        $this->actingAs($user)
            ->put(route("users.update", $user))
            ->assertForbidden();
    }

    public function testUserProfileDataIsRequired(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->put(route("users.update", $user))
            ->assertInvalid([
                "name",
                "email",
            ]);
    }

    public function testProfileDataIsRequired(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->put(route("users.update", $user))
            ->assertInvalid([
                "name",
                "email",
            ]);
    }
}
