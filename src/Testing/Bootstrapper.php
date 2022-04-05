<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Testing;

use Blumilk\BLT\Bootstrapping\LaravelBootstrapper;
use Blumilk\BLT\LaravelContracts;
use Blumilk\Meetup\Core\MeetupApplication;

class Bootstrapper extends LaravelBootstrapper
{
    public function boot(): void
    {
        $meetup = new MeetupApplication(__DIR__ . "/../../", ".env.behat");

        $app = $meetup->getApplication();
        $app->loadEnvironmentFrom($this->environmentFile);

        if (!empty($this->configOverrides)) {
            $app->afterBootstrapping(LaravelContracts::LOAD_CONFIGURATION_CLASS, function ($app): void {
                $app["env"] = $this->environmentType;
                foreach ($this->configOverrides as $key => $value) {
                    $app->make("config")->set($key, $value);
                }
            });
        }

        $app->make($this->getContractToBootstrap())->bootstrap();
    }
}
