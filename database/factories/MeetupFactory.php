<?php

declare(strict_types=1);

namespace Database\Factories;

use Blumilk\Meetup\Core\Models\Meetup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MeetupFactory extends Factory
{
    protected $model = Meetup::class;

    public function definition(): array
    {
        return [
            "title" => $this->faker->word() . " Meetup",
            "description" => $this->faker->text(1000),
            "date" => Carbon::createFromDate(2022, 01, 01),
            "place" => $this->faker->city(),
            "language" => $this->faker->languageCode(),
        ];
    }
}
