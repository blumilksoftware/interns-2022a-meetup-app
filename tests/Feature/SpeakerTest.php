<?php

declare(strict_types=1);

namespace Tests\Feature;

use Blumilk\Meetup\Core\Models\Speaker;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SpeakerTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserCanSeeSpeakersList(): void
    {
        $user = User::factory()->create();
        $speakers = Speaker::factory()->count(10)->create();

        $response = $this->actingAs($user)
            ->get(route("speakers"))
            ->assertOk();

        foreach ($speakers as $speaker) {
            $response->assertSee($speaker->name)
                ->assertSee($speaker->avatar_path);
        }
    }

    public function testSpeakersListIsPaginated(): void
    {
        $user = User::factory()->create();

        Speaker::factory()->count(30)->create();

        $speakers = Speaker::query()
            ->latest()
            ->skip(20)
            ->take(10);

        $response = $this->actingAs($user)
            ->get(route("speakers") . '?page=2')
            ->assertOk();

        foreach ($speakers as $speaker) {
            $response->assertSee($speaker->name)
                ->assertSee($speaker->avatar_path);
        }
    }

    public function testUserCanSeeSpeaker(): void
    {
        $user = User::factory()->create();

        $speaker = Speaker::factory()->create();

        $this->actingAs($user)
            ->get(route("speakers.show"), $speaker)
            ->assertOk()
            ->assertSee($speaker->name)
            ->assertSee($speaker->avatar_path)
            ->assertSee($speaker->description)
            ->assertSee($speaker->linkedin_url)
            ->assertSee($speaker->github_url);
    }

    public function testAdminCanCreateSpeaker(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->get(route("speakers.create"))
            ->assertOk();

        $this->actingAs($admin)
            ->post(route("speakers.store"), [
                "name" => 'speaker',
                "description" => 'speaker description',
                "linkedin_url" => 'https://linkedin.com/example',
                "github_url" => 'https://github.com/example',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas("speakers", [
            "name" => 'speaker',
            "description" => 'speaker description',
            "linkedin_url" => 'https://linkedin.com/example',
            "github_url" => 'https://github.com/example',
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

    public function testAdminCanEditSpeaker(): void
    {
        $admin = User::factory()->admin()->create();

        $speaker = Speaker::factory()->create();

        $this->actingAs($admin)
            ->get(route("speakers.edit", $speaker))
            ->assertOk();

        $this->actingAs($admin)
            ->put(route("speakers.update", $speaker), [
                "name" => 'speaker',
                "description" => 'speaker description',
                "linkedin_url" => 'https://linkedin.com/',
                "github_url" => 'https://github.com/',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas("speakers", [
            "name" => 'speaker',
            "description" => 'speaker description',
            "linkedin_url" => 'https://linkedin.com/',
            "github_url" => 'https://github.com/',
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

    public function testAdminCanDeleteSpeaker(): void
    {
        $admin = User::factory()->admin()->create();

        $speaker = Speaker::factory()->create();

        $this->actingAs($admin)
            ->delete(route("speakers.destroy", $speaker))
            ->assertRedirect();

        $this->assertModelMissing($speaker);
    }

    public function testUserCannotDeleteSpeaker(): void
    {
        $user = User::factory()->admin()->create();

        $speaker = Speaker::factory()->create();

        $this->actingAs($user)
            ->delete(route("speakers.destroy", $speaker))
            ->assertRedirect();
    }
}
