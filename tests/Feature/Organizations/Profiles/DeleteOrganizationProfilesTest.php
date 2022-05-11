<?php

declare(strict_types=1);

namespace Tests\Feature\Organizations\Profiles;

use Blumilk\Meetup\Core\Models\Organization;
use Blumilk\Meetup\Core\Models\OrganizationProfile;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DeleteOrganizationProfilesTest extends TestCase
{
    use RefreshDatabase;

    public User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(["name" => "admin"]);
        $this->admin = User::factory()->create()->assignRole("admin");
    }

    public function testAdminCanDeleteOrganizationProfile(): void
    {
        $organization = Organization::factory()->create();

        OrganizationProfile::factory()
            ->for($organization)
            ->create();

        $this->assertDatabaseCount("organization_profiles", 1);
        $organizationProfile = OrganizationProfile::query()->first();

        $this->actingAs($this->admin)
            ->delete(route("organizations.profiles.destroy", [$organization, $organizationProfile]))
            ->assertRedirect();

        $this->assertModelMissing($organizationProfile);
    }

    public function testUserCannotDeleteOrganizationProfile(): void
    {
        $user = User::factory()->create();

        $organization = Organization::factory()->create();

        OrganizationProfile::factory()
            ->for($organization)
            ->create();

        $this->assertDatabaseCount("organization_profiles", 1);
        $organizationProfile = OrganizationProfile::query()->first();

        $this->actingAs($user)
            ->delete(route("organizations.profiles.destroy", [$organization, $organizationProfile]))
            ->assertForbidden();
    }
}
