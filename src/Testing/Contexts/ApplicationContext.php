<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Testing\Contexts;

use Behat\Behat\Context\Context;
use Blumilk\Meetup\Core\Testing\Contexts\Traits\Environment;
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
}
