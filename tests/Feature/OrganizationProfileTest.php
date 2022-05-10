<?php

declare(strict_types=1);

namespace Tests\Feature;

use Blumilk\Meetup\Core\Models\Organization;
use Blumilk\Meetup\Core\Models\OrganizationProfile;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class OrganizationProfileTest extends TestCase
{
    use DatabaseMigrations;

    public function testAdminCanCreateOrganizationProfile(): void
    {
        $admin = User::factory()->admin()->create();

        $organization = Organization::factory()->create();

        $this->actingAs($admin)
            ->get(route("organizations.profiles.create", $organization))
            ->assertOk();

        $this->actingAs($admin)
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

    public function testAdminCanEditOrganizationProfile(): void
    {
        $admin = User::factory()->admin()->create();

        $organization = Organization::factory()->create();

        $organizationProfile = OrganizationProfile::factory()
            ->for($organization)
            ->create();

        $this->actingAs($admin)
            ->get(route("organizations.profiles.edit", [$organization, $organizationProfile]))
            ->assertOk();

        $this->actingAs($admin)
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

        $organizationProfile = OrganizationProfile::factory()
            ->for($organization)
            ->create();

        $this->actingAs($user)
            ->get(route("organizations.profiles.edit", [$organization, $organizationProfile]))
            ->assertForbidden();

        $this->actingAs($user)
            ->put(route("organizations.profiles.update", [$organization, $organizationProfile]))
            ->assertForbidden();
    }

    public function testAdminCanDeleteOrganizationProfile(): void
    {
        $admin = User::factory()->admin()->create();

        $organization = Organization::factory()->create();

        $organizationProfile = OrganizationProfile::factory()
            ->for($organization)
            ->create();

        $this->assertDatabaseCount("organization_profiles", 1);

        $this->actingAs($admin)
            ->delete(route("organizations.profiles.destroy", [$organization, $organizationProfile]))
            ->assertRedirect();

        $this->assertModelMissing($organizationProfile);
    }

    public function testUserCannotDeleteOrganizationProfile(): void
    {
        $user = User::factory()->create();

        $organization = Organization::factory()->create();

        $organizationProfile = OrganizationProfile::factory()
            ->for($organization)
            ->create();

        $this->actingAs($user)
            ->delete(route("organizations.profiles.destroy", [$organization, $organizationProfile]))
            ->assertForbidden();
    }

    public function testOrganizationProfileRequestHasRelatedOrganization(): void
    {
        $organization = Organization::factory()->create();
        $foreignOrganization = Organization::factory()->create();

        $organizationProfile = OrganizationProfile::factory()
            ->for($organization)
            ->create();

        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->put(route("organizations.profiles.store", [$foreignOrganization, $organizationProfile]))
            ->assertNotFound();

        $this->actingAs($admin)
            ->put(route("organizations.profiles.update", [$foreignOrganization, $organizationProfile]))
            ->assertNotFound();

        $this->actingAs($admin)
            ->delete(route("organizations.profiles.destroy", [$foreignOrganization, $organizationProfile]))
            ->assertNotFound();
    }
}
