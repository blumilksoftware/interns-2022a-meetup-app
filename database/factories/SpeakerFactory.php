<?php

declare(strict_types=1);

namespace Database\Factories;

use Blumilk\Meetup\Core\Models\Speaker;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpeakerFactory extends Factory
{
    protected $model = Speaker::class;

    public function definition(): array
    {
        return [
            "name" => $this->faker->firstName() . " " . $this->faker->lastName(),
            "description" => $this->faker->word(),
            "avatar_path" => "",
            "linkedin_url" => "https://pl.linkedin.com/",
            "github_url" => "https://github.com/",
        ];
    }
}
