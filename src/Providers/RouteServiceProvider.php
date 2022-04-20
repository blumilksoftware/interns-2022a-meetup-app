<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Providers;

use Blumilk\Meetup\Core\Http\Routing\ApiRouting;
use Blumilk\Meetup\Core\Http\Routing\WebRouting;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        /** @var Router $router */
        $router = $this->app["router"];

        $this->configureRateLimiting();

        $this->routes(function () use ($router): void {
            $router->middleware("api")
                ->prefix("api")
                ->namespace($this->namespace)
                ->group(fn() => new ApiRouting($router));

            $router->middleware("web")
                ->namespace($this->namespace)
                ->group(fn() => new WebRouting($router));
        });
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for(
            "api",
            fn(Request $request) => Limit::perMinute(60)->by(
                $request->user()?->id ?: $request->ip(),
            ),
        );
        RateLimiter::for(
            "web",
            fn(Request $request): Limit => Limit::perMinute(60)->by(
                $request->user()?->id ?: $request->ip(),
            ),
        );
    }
}
