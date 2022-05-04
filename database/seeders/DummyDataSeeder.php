<?php

declare(strict_types=1);

namespace Database\Seeders;

use Blumilk\Meetup\Core\Models\Meetup;
use Blumilk\Meetup\Core\Models\Organization;
use Blumilk\Meetup\Core\Models\OrganizationProfile;
use Blumilk\Meetup\Core\Models\Speaker;
use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Models\Utils\Constants;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory([
            "name" => "Admin",
            "email" => "admin@example.com",
            "password" => "password",
            "email_verified_at" => Carbon::createFromDate(2022, 01, 01),
            "avatar_path" => Constants::USER_DEFAULT_AVATAR_PATH,
        ])->create();

        $organizations = Organization::factory(10)->create();
        $speakers = Speaker::factory(25)->create();

        foreach ($speakers as $speaker) {
            Meetup::factory()->create([
                "user_id" => $user,
                "speaker_id" => $speakers->random(),
                "organization_id" => $organizations->random(),
            ]);
            OrganizationProfile::factory()->create([
                "organization_id" => $organizations->random(),
            ]);
        }
    }
}
