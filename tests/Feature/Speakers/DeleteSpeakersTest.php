<?php

declare(strict_types=1);

namespace Tests\Feature\Speakers;

use Blumilk\Meetup\Core\Models\Speaker;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DeleteSpeakersTest extends TestCase
{
    use RefreshDatabase;

    public User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(["name" => "admin"]);
        $this->admin = User::factory()->create()->assignRole("admin");
    }

    public function testAdminCanDeleteSpeaker(): void
    {
        $speaker = Speaker::factory()->create();

        $this->actingAs($this->admin)
            ->delete(route("speakers.destroy", $speaker))
            ->assertRedirect();

        $this->assertModelMissing($speaker);
    }

    public function testUserCannotDeleteSpeaker(): void
    {
        $user = User::factory()->create();

        $speaker = Speaker::factory()->create();

        $this->actingAs($user)
            ->delete(route("speakers.destroy", $speaker))
            ->assertForbidden();
    }
}
