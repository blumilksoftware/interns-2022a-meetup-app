<?php

declare(strict_types=1);

namespace Tests\Feature\Meetups;

use Blumilk\Meetup\Core\Models\Meetup;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DeleteMeetupsTest extends TestCase
{
    use RefreshDatabase;

    public User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(["name" => "admin"]);
        $this->admin = User::factory()->create()->assignRole("admin");
    }

    public function testAdminCanDeleteMeetup(): void
    {
        $meetup = Meetup::factory()->for($this->admin)->create();

        $this->actingAs($this->admin)
            ->delete(route("meetups.destroy", $meetup))
            ->assertRedirect();

        $this->assertModelMissing($meetup);
    }

    public function testUserCannotDeleteMeetup(): void
    {
        $meetup = Meetup::factory()->for($this->admin)->create();

        $user = User::factory()->create();

        $this->actingAs($user)
            ->delete(route("meetups.destroy", $meetup))
            ->assertForbidden();
    }
}
