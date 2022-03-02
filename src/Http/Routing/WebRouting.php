<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Routing;

use Blumilk\Meetup\Core\Http\Controllers\AuthController;
use Laravel\Socialite\Facades\Socialite;

class WebRouting extends Routing
{
    public function wire(): void
    {
        $this->router->get("/", fn() => view("welcome"))->name("home");

        $this->router->post("/auth/register", [AuthController::class, "create"])->name("create")->middleware();
        $this->router->post("/auth/login", [AuthController::class, "login"])->name("login");
        $this->router->post("/auth/logout", [AuthController::class, "logout"])->name("logout");
        $this->router->get('/auth/google/redirect', [SocialiteController::class, "redirectToGoogle"])->name("login.google");
        $this->router->get('/auth/google/callback', [SocialiteController::class, "handleGoogleCallback"]);
        $this->router->get('/auth/facebook/redirect', [SocialiteController::class, "redirectToFacebook"])->name("login.facebook");
        $this->router->get('/auth/facebook/callback',[SocialiteController::class, "handleFacebookCallback"]);
    }
}

