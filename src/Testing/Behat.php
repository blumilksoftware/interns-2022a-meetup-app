<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Testing;

use Blumilk\BLT\Extensions\LaravelApplicationBehatExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Behat extends LaravelApplicationBehatExtension
{
    public function load(ContainerBuilder $container, array $config = []): void
    {
        $bootstrap = new Bootstrapper();
        $bootstrap->setBasePath($container->getParameter("paths.base"));
        $bootstrap->setEnvironmentFile($config["env"] ?? ".env.behat");
        $bootstrap->boot();
    }
}
