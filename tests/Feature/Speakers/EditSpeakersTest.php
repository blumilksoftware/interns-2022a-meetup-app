<?php

declare(strict_types=1);

namespace Tests\Feature\Speakers;

use Blumilk\Meetup\Core\Models\Speaker;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class EditSpeakersTest extends TestCase
{
    use RefreshDatabase;

    public User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(["name" => "admin"]);
        $this->admin = User::factory()->create()->assignRole("admin");
    }

    public function testAdminCanEditSpeaker(): void
    {
        $speaker = Speaker::factory()->create();

        $this->actingAs($this->admin)
            ->get(route("speakers.edit", $speaker))
            ->assertOk();

        $this->actingAs($this->admin)
            ->put(route("speakers.update", $speaker), [
                "name" => "speaker",
                "description" => "speaker description",
                "linkedin_url" => "https://linkedin.com/",
                "github_url" => "https://github.com/",
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas("speakers", [
            "name" => "speaker",
            "description" => "speaker description",
            "linkedin_url" => "https://linkedin.com/",
            "github_url" => "https://github.com/",
        ]);
    }

    public function testUserCannotEditSpeaker(): void
    {
        $user = User::factory()->create();

        $speaker = Speaker::factory()->create();

        $this->actingAs($user)
            ->get(route("speakers.edit", $speaker))
            ->assertForbidden();

        $this->actingAs($user)
            ->put(route("speakers.update", $speaker))
            ->assertForbidden();
    }
}
