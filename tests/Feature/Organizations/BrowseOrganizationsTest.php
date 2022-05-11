<?php

declare(strict_types=1);

namespace Tests\Feature\Organizations;

use Blumilk\Meetup\Core\Models\Meetup;
use Blumilk\Meetup\Core\Models\Organization;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrowseOrganizationsTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanSeeOrganizationsList(): void
    {
        $organizations = Organization::factory()->count(10)->create();

        $this->assertDatabaseCount("organizations", 10);

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

        $this->assertDatabaseCount("organizations", 30);

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
}
