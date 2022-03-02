<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        User::truncate();

        $faker = \Faker\Factory::create();

        User::create([
            "name" => "Admin",
            "email" => "admin@test.com",
            "password" => Hash::make("admin123"),
        ]);

        User::create([
            "name" => $faker->name,
            "email" => $faker->email,
            "password" => Hash::make("password1"),
        ]);
    }
}
