<?php

declare(strict_types=1);

namespace Tests\Feature\Organizations;

use Blumilk\Meetup\Core\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CreateOrganizationsTest extends TestCase
{
    use RefreshDatabase;

    public User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(["name" => "admin"]);
        $this->admin = User::factory()->create()->assignRole("admin");
    }

    public function testAdminCanCreateOrganization(): void
    {
        $this->actingAs($this->admin)
            ->get(route("organizations.create"))
            ->assertOk();

        $this->actingAs($this->admin)
            ->post(route("organizations.store"), [
                "name" => "Test organization",
                "description" => "Test organization description",
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
}
