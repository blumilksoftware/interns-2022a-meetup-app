<?php

declare(strict_types=1);

namespace Tests\Feature;

use Blumilk\Meetup\Core\Models\Meetup;
use Blumilk\Meetup\Core\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MeetupTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserCanSeeMeetupsList(): void
    {
        $admin = User::factory()->admin()->create();
        $meetups = Meetup::factory()
            ->count(15)
            ->for($admin)
            ->create();

        $this->assertDatabaseCount('meetups', 15);

        $response = $this->get(route('meetups'))
            ->assertOk();

        foreach ($meetups as $meetup) {
            $response->assertSee($meetup->logo_path)
                ->assertSee($meetup->title)
                ->assertSee($meetup->date->format('Y-m-d h:i'))
                ->assertSee($meetup->place);
        }
    }

    public function testMeetupsListIsPaginated(): void
    {
        $admin = User::factory()->admin()->create();
        Meetup::factory()
            ->count(30)
            ->for($admin)
            ->create();

        $meetups = Meetup::query()
            ->latest()
            ->skip(20)
            ->take(10);

        $this->assertDatabaseCount('meetups', 30);

        $response = $this->get(route('meetups') . '?page=2')
            ->assertOk();

        foreach ($meetups as $meetup) {
            $response->assertSee($meetup->logo_path)
                ->assertSee($meetup->title)
                ->assertSee($meetup->date->format('Y-m-d h:i'))
                ->assertSee($meetup->place);
        }
    }

    public function testUserCanSeeMeetup(): void
    {
        $admin = User::factory()->admin()->create();
        $meetup = Meetup::factory()->for($admin)->create();

        $this->get(route('meetups.show', $meetup))
            ->assertOk()
            ->assertSee($meetup->logo_path)
            ->assertSee($meetup->title)
            ->assertSee($meetup->date->format('Y-m-d h:i'))
            ->assertSee($meetup->place)
            ->assertSee($meetup->language);
    }

    public function testAdminCanCreateMeetup(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->get(route("meetups.create"))
            ->assertOk();

        $this->actingAs($admin)
            ->post(route("meetups.store"), [
                "title" => "Test Meetup",
                "description" => "Description",
                "date" => Carbon::parse('2022-12-12 12:00:00'),
                "place" => "Place",
                "language" => "en",
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route("meetups.create"));

        $this->assertDatabaseHas("meetups", [
            "user_id" => $admin->id,
            "title" => "Test Meetup",
            "description" => "Description",
            "date" => Carbon::parse('2022-12-12 12:00:00'),
            "place" => "Place",
            "language" => "en",
        ]);
    }

    public function testUserCannotCreateMeetup(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route("meetups.create"))
            ->assertForbidden();

        $this->actingAs($user)
            ->post(route("meetups.store"))
            ->assertForbidden();
    }

    public function testAdminCanEditMeetup(): void
    {
        $admin = User::factory()->admin()->create();
        $meetup = Meetup::factory()->for($admin)->create();

        $this->actingAs($admin)
            ->get(route("meetups.edit", $meetup))
            ->assertOk();

        $this->actingAs($admin)
            ->put(route("meetups.update", $meetup), [
                "title" => "Test Meetup",
                "description" => "Description",
                "date" => Carbon::parse('2022-12-12 12:00:00'),
                "place" => "Place",
                "language" => "en",
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route("meetups.edit"));

        $this->assertDatabaseHas("meetups", [
            "user_id" => $admin->id,
            "title" => "Test Meetup",
            "description" => "Description",
            "date" => Carbon::parse('2022-12-12 12:00:00'),
            "place" => "Place",
            "language" => "en",
        ]);
    }

    public function testUserCannotEditMeetup(): void
    {
        $admin = User::factory()->create();
        $meetup = Meetup::factory()->for($admin)->create();

        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route("meetups.edit", $meetup))
            ->assertForbidden();

        $this->actingAs($admin)
            ->put(route("meetups.update", $meetup))
            ->assertForbidden();
    }

    public function testAdminCanDeleteMeetup(): void
    {
        $admin = User::factory()->admin()->create();

        $meetup = Meetup::factory()->for($admin)->create();

        $this->actingAs($admin)
            ->delete(route("meetups.destroy", $meetup))
            ->assertRedirect();

        $this->assertModelMissing($meetup);
    }

    public function testUserCannotDeleteMeetup(): void
    {
        $admin = User::factory()->admin()->create();
        $meetup = Meetup::factory()->for($admin)->create();

        $user = User::factory()->create();

        $this->actingAs($user)
            ->delete(route("meetups.destroy", $meetup))
            ->assertForbidden();
    }
}
