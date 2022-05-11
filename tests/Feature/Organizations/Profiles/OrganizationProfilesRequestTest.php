<?php

declare(strict_types=1);

namespace Tests\Feature\Organizations\Profiles;

use Blumilk\Meetup\Core\Models\Organization;
use Blumilk\Meetup\Core\Models\OrganizationProfile;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class OrganizationProfilesRequestTest extends TestCase
{
    use RefreshDatabase;

    public User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(["name" => "admin"]);
        $this->admin = User::factory()->create()->assignRole("admin");
    }

    public function testOrganizationProfileRequestHasRelatedOrganization(): void
    {
        $organization = Organization::factory()->create();
        $foreignOrganization = Organization::factory()->create();

        $organizationProfile = OrganizationProfile::factory()
            ->for($organization)
            ->create();

        $this->actingAs($this->admin)
            ->get(route("organizations.profiles.create", [$foreignOrganization, $organizationProfile]))
            ->assertNotFound();

        $this->actingAs($this->admin)
            ->get(route("organizations.profiles.edit", [$foreignOrganization, $organizationProfile]))
            ->assertNotFound();

        $this->actingAs($this->admin)
            ->post(route("organizations.profiles.store", [$foreignOrganization, $organizationProfile]))
            ->assertNotFound();

        $this->actingAs($this->admin)
            ->put(route("organizations.profiles.update", [$foreignOrganization, $organizationProfile]))
            ->assertNotFound();

        $this->actingAs($this->admin)
            ->delete(route("organizations.profiles.destroy", [$foreignOrganization, $organizationProfile]))
            ->assertNotFound();
    }
}
