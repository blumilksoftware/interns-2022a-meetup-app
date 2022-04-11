<?php

declare(strict_types=1);

namespace Database\Factories;

use Blumilk\Meetup\Core\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            "id" => $this->faker->randomNumber(),
            "name" => $this->faker->name,
            "email" => $this->faker->unique()->safeEmail(),
            "email_verified_at" => now(),
            "password" => Hash::make("password"),
            "remember_token" => Str::random(10),
        ];
    }

    public function unverified(): Factory
    {
        return $this->state(function (array $attributes): array {
            return [
                "email_verified_at" => null,
            ];
        });
    }
}
