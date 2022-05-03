<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\Meetup;

class SyncSpeakersService
{
    public function syncSpeakers(Meetup $meetup, ?array $speakers): void
    {
        $meetup->speakers()->sync($speakers);
    }
}
