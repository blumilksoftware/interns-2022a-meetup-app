<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Testing\Contexts;

use Behat\Behat\Context\Context;
use Blumilk\BLT\Features\Traits\Environment;
use Blumilk\Meetup\Core\Testing\Bootstrapper;
use PHPUnit\Framework\Assert;

class ApplicationContext implements Context
{
    use Environment;

    /**
     * @Given application name is :name
     */
    public function applicationNameIs(string $name): void
    {
        Assert::assertEquals($name, config("app.name"));
    }

    /**
     * @Given application is booted with config:
     */
    public function applicationIsBootedWithConfig(array $config): void
    {
        $bootstrap = new Bootstrapper();
        $bootstrap->setConfigOverrides($config);

        if (array_key_exists("app.env", $config)) {
            $bootstrap->setEnvironmentType($config["app.env"]);
        }

        $bootstrap->boot();
    }
}
