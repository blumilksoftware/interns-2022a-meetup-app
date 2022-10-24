<?php

declare(strict_types=1);

namespace Tests\Feature\Meetups;

use Blumilk\Meetup\Core\Models\Meetup;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class BrowseMeetupsTest extends TestCase
{
    use RefreshDatabase;

    public User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(["name" => "admin"]);
        $this->admin = User::factory()->create()->assignRole("admin");
    }

    public function testUserCanSeeMeetupsList(): void
    {
        $meetups = Meetup::factory()
            ->count(15)
            ->for($this->admin)
            ->create();

        $this->assertDatabaseCount("meetups", 15);

        $response = $this->get(route("meetups"))
            ->assertOk();

        foreach ($meetups as $meetup) {
            $response->assertSee($meetup->logo_path)
                ->assertSee($meetup->title)
                ->assertSee($meetup->date->toDateString())
                ->assertSee($meetup->place);
        }
    }

    public function testMeetupsListIsPaginated(): void
    {
        Meetup::factory()
            ->count(30)
            ->for($this->admin)
            ->create();

        $meetups = Meetup::query()
            ->latest()
            ->skip(20)
            ->take(10);

        $this->assertDatabaseCount("meetups", 30);

        $response = $this->get(route("meetups") . "?page=2")
            ->assertOk();

        foreach ($meetups as $meetup) {
            $response->assertSee($meetup->logo_path)
                ->assertSee($meetup->title)
                ->assertSee($meetup->date->format("Y-m-d h:i"))
                ->assertSee($meetup->place);
        }
    }
}
