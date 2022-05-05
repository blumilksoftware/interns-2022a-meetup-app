<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http;

use Blumilk\Meetup\Core\Http\Middleware\IsAdmin;
use Fruitcake\Cors\HandleCors;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Http\Middleware\TrustProxies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

class Kernel extends HttpKernel
{
    protected $middleware = [
        TrustProxies::class,
        HandleCors::class,
        PreventRequestsDuringMaintenance::class,
        ValidatePostSize::class,
        Middleware\TrimStrings::class,
        ConvertEmptyStringsToNull::class,
    ];
    protected $middlewareGroups = [
        "web" => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            "throttle:web",
        ],

        "api" => [
            EnsureFrontendRequestsAreStateful::class,
            "throttle:api",
            SubstituteBindings::class,
        ],
    ];
    protected $routeMiddleware = [
        "auth" => Middleware\Authenticate::class,
        "auth.basic" => AuthenticateWithBasicAuth::class,
        "cache.headers" => SetCacheHeaders::class,
        "can" => Authorize::class,
        "guest" => Middleware\RedirectIfAuthenticated::class,
        "password.confirm" => RequirePassword::class,
        "signed" => ValidateSignature::class,
        "throttle" => ThrottleRequests::class,
        "verified" => EnsureEmailIsVerified::class,
        "admin" => IsAdmin::class,
    ];
}
