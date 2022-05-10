<?php

declare(strict_types=1);

namespace Tests\Feature;

use Blumilk\Meetup\Core\Models\Meetup;
use Blumilk\Meetup\Core\Models\Organization;
use Blumilk\Meetup\Core\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserCanSeeOrganizationsList(): void
    {
        $organizations = Organization::factory()->count(10)->create();

        $this->assertDatabaseCount("meetups", 10);

        $response = $this->get(route("organizations"))
            ->assertOk();

        foreach ($organizations as $organization) {
            $response->assertSee($organization->name)
                ->assertSee($organization->logo_path)
                ->assertSee($organization->description);
        }
    }

    public function testOrganizationsListIsPaginated(): void
    {
        Organization::factory()->count(30)->create();

        $this->assertDatabaseCount("meetups", 30);

        $organizations = Meetup::query()
            ->latest()
            ->skip(20)
            ->take(10);

        $response = $this->get(route("organizations") . "?page=2")
            ->assertOk();

        foreach ($organizations as $organization) {
            $response->assertSee($organization->name)
                ->assertSee($organization->logo_path)
                ->assertSee($organization->description);
        }
    }

    public function testUserCanSeeOrganization(): void
    {
        $organization = Organization::factory()->create();

        $this->get(route("organizations.show", $organization))
            ->assertOk()
            ->assertSee($organization->name)
            ->assertSee($organization->logo_path)
            ->assertSee($organization->description)
            ->assertSee($organization->location)
            ->assertSee($organization->foundation_date)
            ->assertSee($organization->website_url)
            ->assertSee($organization->number_of_employees);
    }

    public function testAdminCanCreateOrganization(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->get(route("organizations.create"))
            ->assertOk();

        $this->actingAs($admin)
            ->post(route("organizations.store"), [
                "name" => "Test organization",
                "description" => "Test organization description",
                "location" => "Panama",
                "organization_type" => "test",
                "foundation_date" => Carbon::parse("2022-01-01 10:00:00"),
                "number_of_employees" => 1000,
                "website_url" => "https://testorganization.info",
            ])
            ->assertRedirect(route("organizations.create"));

        $this->assertDatabaseHas("organizations", [
            "name" => "Test organization",
            "description" => "Test organization description",
            "location" => "Panama",
            "organization_type" => "test",
            "foundation_date" => Carbon::parse("2022-01-01 10:00:00"),
            "number_of_employees" => 1000,
            "website_url" => "https://testorganization.info",
        ]);
    }

    public function testUserCannotCreateOrganization(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route("organizations.create"))
            ->assertForbidden();

        $this->actingAs($user)
            ->post(route("organizations.store"))
            ->assertForbidden();
    }

    public function testAdminCanEditOrganization(): void
    {
        $admin = User::factory()->admin()->create();
        $organization = Organization::factory()->create();

        $this->actingAs($admin)
            ->get(route("organizations.edit", $organization))
            ->assertOk();

        $this->actingAs($admin)
            ->put(route("organizations.update", $organization), [
                "name" => "Test organization",
                "description" => "Test description",
                "location" => "Panama",
                "organization_type" => "test",
                "foundation_date" => Carbon::parse("2022-01-01 10:00:00"),
                "number_of_employees" => 1000,
                "website_url" => "https://testorganization.info",
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route("organizations.edit", $organization));

        $this->assertDatabaseHas("organizations", [
            "name" => "Test organization",
            "description" => "Test description",
            "location" => "Panama",
            "organization_type" => "test",
            "foundation_date" => Carbon::parse("2022-01-01 10:00:00"),
            "number_of_employees" => 1000,
            "website_url" => "https://testorganization.info",
        ]);
    }

    public function testUserCannotEditOrganization(): void
    {
        $organization = Organization::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route("organizations.edit", $organization))
            ->assertForbidden();
    }

    public function testAdminCanDeleteOrganization(): void
    {
        $admin = User::factory()->admin()->create();

        $organization = Organization::factory()->create();

        $this->actingAs($admin)
            ->delete(route("organizations.destroy", $organization))
            ->assertRedirect();

        $this->assertModelMissing($organization);
    }

    public function testUserCannotDeleteOrganization(): void
    {
        $admin = User::factory()->admin()->create();

        $organization = Organization::factory()->create();

        $this->actingAs($admin)
            ->delete(route("organizations.destroy", $organization));
    }
}
