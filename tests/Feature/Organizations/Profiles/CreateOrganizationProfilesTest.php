<?php

declare(strict_types=1);

namespace Tests\Feature\Organizations\Profiles;

use Blumilk\Meetup\Core\Models\Organization;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CreateOrganizationProfilesTest extends TestCase
{
    use RefreshDatabase;

    public User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(["name" => "admin"]);
        $this->admin = User::factory()->create()->assignRole("admin");
    }

    public function testAdminCanCreateOrganizationProfile(): void
    {
        $organization = Organization::factory()->create();

        $this->actingAs($this->admin)
            ->get(route("organizations.profiles.create", $organization))
            ->assertOk();

        $this->actingAs($this->admin)
            ->post(route("organizations.profiles.store", $organization), [
                "label" => "Facebook",
                "link" => "https://facebook.com",
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas("organization_profiles", [
            "organization_id" => $organization->id,
            "label" => "Facebook",
            "link" => "https://facebook.com",
        ]);
    }

    public function testUserCannotCreateOrganizationProfile(): void
    {
        $user = User::factory()->create();

        $organization = Organization::factory()->create();

        $this->actingAs($user)
            ->get(route("organizations.profiles.create", $organization))
            ->assertForbidden();

        $this->actingAs($user)
            ->post(route("organizations.profiles.store", $organization))
            ->assertForbidden();
    }
}
