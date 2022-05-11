<?php

declare(strict_types=1);

namespace Tests\Feature\Speakers;

use Blumilk\Meetup\Core\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CreateSpeakersTest extends TestCase
{
    use RefreshDatabase;

    public User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(["name" => "admin"]);
        $this->admin = User::factory()->create()->assignRole("admin");
    }

    public function testAdminCanCreateSpeaker(): void
    {
        $this->actingAs($this->admin)
            ->get(route("speakers.create"))
            ->assertOk();

        $this->actingAs($this->admin)
            ->post(route("speakers.store"), [
                "name" => "speaker",
                "description" => "speaker description",
                "linkedin_url" => "https://linkedin.com/example",
                "github_url" => "https://github.com/example",
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas("speakers", [
            "name" => "speaker",
            "description" => "speaker description",
            "linkedin_url" => "https://linkedin.com/example",
            "github_url" => "https://github.com/example",
        ]);
    }

    public function testUserCannotCreateSpeaker(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route("speakers.create"))
            ->assertForbidden();

        $this->actingAs($user)
            ->post(route("speakers.store"))
            ->assertForbidden();
    }
}
