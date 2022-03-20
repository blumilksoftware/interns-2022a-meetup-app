<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function __construct(
        protected Redirector $redirector,
        protected AuthManager $authManager,
    ) {}

    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if ($this->authManager->guard($guard)->check()) {
                return $this->redirector->to(route("home"));
            }
        }

        return $next($request);
    }
}
