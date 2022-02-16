<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Routing;

class WebRouting extends Routing
{
    public function wire(): void
    {
        $this->router->get("/", fn() => view("welcome"))->name("home");
    }
}
