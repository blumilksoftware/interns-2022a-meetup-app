<?php

declare(strict_types=1);

namespace Database\Factories;

use Blumilk\Meetup\Core\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    public function definition(): array
    {
        return [
            "name" => $this->faker->company(),
            "description" => $this->faker->text(1000),
            "location" => $this->faker->country(),
            "organization_type" => $this->faker->word(),
            "foundation_date" => Carbon::createFromDate(2022, 01, 01),
            "number_of_employees" => $this->faker->randomNumber(),
            "website_url" => $this->faker->url(),
        ];
    }
}
