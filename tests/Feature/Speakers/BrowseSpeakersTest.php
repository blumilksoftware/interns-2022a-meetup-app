<?php

declare(strict_types=1);

namespace Tests\Feature\Speakers;

use Blumilk\Meetup\Core\Models\Speaker;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrowseSpeakersTest extends TestCase
{
    use RefreshDatabase;

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
            ->get(route("speakers") . "?page=2")
            ->assertOk();

        foreach ($speakers as $speaker) {
            $response->assertSee($speaker->name)
                ->assertSee($speaker->avatar_path);
        }
    }
}
