<?php

declare(strict_types=1);

namespace Tests\Feature\Meetups;

use Blumilk\Meetup\Core\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CreateMeetupsTest extends TestCase
{
    use RefreshDatabase;

    public User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(["name" => "admin"]);
        $this->admin = User::factory()->create()->assignRole("admin");
    }

    public function testAdminCanCreateMeetup(): void
    {
        $this->actingAs($this->admin)
            ->get(route("meetups.create"))
            ->assertOk();

        $this->actingAs($this->admin)
            ->post(route("meetups.store"), [
                "title" => "Test Meetup",
                "description" => "Description",
                "date" => Carbon::parse("2022-12-12 12:00:00"),
                "place" => "Place",
                "language" => "en",
                "organizations" => "",
                "speakers" => "",
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas("meetups", [
            "user_id" => $this->admin->id,
            "title" => "Test Meetup",
            "description" => "Description",
            "date" => Carbon::parse("2022-12-12 12:00:00"),
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
}
