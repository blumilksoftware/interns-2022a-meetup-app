<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Testing\Contexts\Traits;

use Blumilk\BLT\Bootstrapping\LaravelBootstrapper;
use Blumilk\BLT\Features\Traits\Environment as BLTEnvironment;
use Blumilk\Meetup\Core\Testing\Bootstrapper;

trait Environment
{
    use BLTEnvironment;

    protected function provideBootstraper(): LaravelBootstrapper
    {
        return new Bootstrapper();
    }
}
