<?php

declare(strict_types=1);

namespace Database\Factories;

use Blumilk\Meetup\Core\Enums\AvailableProfiles;
use Blumilk\Meetup\Core\Models\OrganizationProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationProfileFactory extends Factory
{
    protected $model = OrganizationProfile::class;

    public function definition(): array
    {
        return [
            "label" => $this->faker->randomElement(AvailableProfiles::cases()),
            "link" => $this->faker->url(),
        ];
    }
}
