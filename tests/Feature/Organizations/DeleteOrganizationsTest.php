<?php

declare(strict_types=1);

namespace Tests\Feature\Organizations;

use Blumilk\Meetup\Core\Models\Organization;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DeleteOrganizationsTest extends TestCase
{
    use RefreshDatabase;

    public User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(["name" => "admin"]);
        $this->admin = User::factory()->create()->assignRole("admin");
    }

    public function testAdminCanDeleteOrganization(): void
    {
        $organization = Organization::factory()->create();

        $this->actingAs($this->admin)
            ->delete(route("organizations.destroy", $organization))
            ->assertRedirect();

        $this->assertModelMissing($organization);
    }

    public function testUserCannotDeleteOrganization(): void
    {
        $user = User::factory()->create();

        $organization = Organization::factory()->create();

        $this->actingAs($user)
            ->delete(route("organizations.destroy", $organization))
            ->assertForbidden();
    }
}
