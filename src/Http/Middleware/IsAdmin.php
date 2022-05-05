<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Middleware;

use Blumilk\Meetup\Core\Enums\Role;
use Blumilk\Meetup\Core\Models\User;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if ($this->isAdmin($request->user())) {
            return $next($request);
        }

        return redirect()->route("home");
    }

    private function isAdmin(?User $user): bool
    {
        return $user && $user->role === Role::Administrator;
    }
}
