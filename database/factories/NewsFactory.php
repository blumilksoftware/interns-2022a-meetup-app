<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    public function definition(): array
    {
        return [
            "title" => $this->faker->unique()->word() . " News",
            "text" => $this->faker->text(1000),
        ];
    }
}
