<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Routing;

use Illuminate\Routing\Router;

abstract class Routing
{
    public function __construct(
        protected Router $router,
    ) {
        $this->wire();
    }

    abstract public function wire(): void;
}
