<?php

declare(strict_types=1);

namespace Database\Seeders;

use Blumilk\Meetup\Core\Models\Meetup;
use Blumilk\Meetup\Core\Models\News;
use Blumilk\Meetup\Core\Models\Organization;
use Blumilk\Meetup\Core\Models\OrganizationProfile;
use Blumilk\Meetup\Core\Models\Speaker;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory([
            "name" => "Admin",
            "email" => "admin@example.com",
            "password" => Hash::make("password"),
            "email_verified_at" => Carbon::createFromDate(2022, 01, 01),
        ])->create();

        $organizations = Organization::factory(10)->create();
        $speakers = Speaker::factory(25)->create();

        News::factory(25)->for($user)->create();
        foreach ($speakers as $speaker) {
            Meetup::factory()->create([
                "user_id" => $user,
                "organization_id" => $organizations->random(),
            ])->speakers()->attach($speakers->random());

            OrganizationProfile::factory()->create([
                "organization_id" => $organizations->random(),
            ]);
        }
    }
}
