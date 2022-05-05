<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Middleware;

use Blumilk\Meetup\Core\Enums\Role;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if ($request->user() && $request->user()->role === Role::Administrator) {
            return $next($request);
        }

        return redirect()->route("home");
    }
}
