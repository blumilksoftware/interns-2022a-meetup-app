<?php

declare(strict_types=1);

namespace Tests\Feature\Organizations\Profiles;

use Blumilk\Meetup\Core\Models\Organization;
use Blumilk\Meetup\Core\Models\OrganizationProfile;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class EditOrganizationProfilesTest extends TestCase
{
    use RefreshDatabase;

    public User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(["name" => "admin"]);
        $this->admin = User::factory()->create()->assignRole("admin");
    }

    public function testAdminCanEditOrganizationProfile(): void
    {
        $organization = Organization::factory()->create();

        OrganizationProfile::factory()
            ->for($organization)
            ->create();

        $this->assertDatabaseCount("organization_profiles", 1);
        $organizationProfile = OrganizationProfile::query()->first();

        $this->actingAs($this->admin)
            ->get(route("organizations.profiles.edit", [$organization, $organizationProfile]))
            ->assertOk();

        $this->actingAs($this->admin)
            ->put(route("organizations.profiles.update", [$organization, $organizationProfile]), [
                "label" => "Twitter",
                "link" => "https://twitter.com",
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas("organization_profiles", [
            "organization_id" => $organization->id,
            "label" => "Twitter",
            "link" => "https://twitter.com",
        ]);
    }

    public function testUserCannotEditOrganizationProfile(): void
    {
        $user = User::factory()->create();

        $organization = Organization::factory()->create();

        OrganizationProfile::factory()
            ->for($organization)
            ->create();

        $this->assertDatabaseCount("organization_profiles", 1);
        $organizationProfile = OrganizationProfile::query()->first();

        $this->actingAs($user)
            ->get(route("organizations.profiles.edit", [$organization, $organizationProfile]))
            ->assertForbidden();

        $this->actingAs($user)
            ->put(route("organizations.profiles.update", [$organization, $organizationProfile]))
            ->assertForbidden();
    }
}
