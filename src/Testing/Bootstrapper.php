<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Testing;

use Blumilk\BLT\Bootstrapping\LaravelBootstrapper;
use Blumilk\Meetup\Core\MeetupApplication;

class Bootstrapper extends LaravelBootstrapper
{
    protected function getApplication()
    {
        $meetup = new MeetupApplication(__DIR__ . "/../../", ".env.behat");

        return $meetup->getApplication();
    }
}
