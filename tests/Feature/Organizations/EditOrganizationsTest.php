<?php

declare(strict_types=1);

namespace Tests\Feature\Organizations;

use Blumilk\Meetup\Core\Models\Organization;
use Blumilk\Meetup\Core\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class EditOrganizationsTest extends TestCase
{
    use RefreshDatabase;

    public User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(["name" => "admin"]);
        $this->admin = User::factory()->create()->assignRole("admin");
    }

    public function testAdminCanEditOrganization(): void
    {
        $organization = Organization::factory()->create();

        $this->actingAs($this->admin)
            ->get(route("organizations.edit", $organization))
            ->assertOk();

        $this->actingAs($this->admin)
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
            ->assertRedirect();

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
}
