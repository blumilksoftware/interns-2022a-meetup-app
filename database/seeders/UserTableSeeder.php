<?php

declare(strict_types=1);

namespace Database\Seeders;

use Blumilk\Meetup\Core\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        User::truncate();

        $faker = Factory::create();

        User::create([
            "name" => "Admin",
            "email" => "admin@example.com",
            "password" => Hash::make("password"),
        ]);

        User::create([
            "name" => $faker->name,
            "email" => $faker->email,
            "password" => Hash::make("password"),
        ]);
    }
}
