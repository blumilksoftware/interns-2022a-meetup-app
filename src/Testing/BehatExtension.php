<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Testing;

use Blumilk\BLT\Bootstrapping\BootstrapperContract;
use Blumilk\BLT\Extensions\LaravelApplicationBehatExtension;

class BehatExtension extends LaravelApplicationBehatExtension
{
    protected function provideBootstrapper(): BootstrapperContract
    {
        return new Bootstrapper();
    }
}
