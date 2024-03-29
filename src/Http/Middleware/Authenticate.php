<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): string
    {
        if (!$request->expectsJson()) {
            return route("login");
        }

        return route("home");
    }
}
