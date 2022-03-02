<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {

        User::truncate();

        $faker = \Faker\Factory::create();


        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin123'),
        ]);

        User::create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => Hash::make('password1'),
        ]);
    }
}

