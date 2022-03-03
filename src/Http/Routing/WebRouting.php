<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Routing;

use Blumilk\Meetup\Core\Http\Controllers\Auth\LoginController;
use Blumilk\Meetup\Core\Http\Controllers\Auth\RegisterController;
use Blumilk\Meetup\Core\Http\Controllers\Auth\SocialiteController;

class WebRouting extends Routing
{
    public function wire(): void
    {
        $this->router->get("/", fn() => view("welcome"))->name("home");

        $this->router->get("/auth/register", [RegisterController::class, "formPage"])->name("register.form");
        $this->router->post("/auth/register", [RegisterController::class, "create"])->name("register");
        $this->router->get("/auth/login", [LoginController::class, "formPage"])->name("login.form");
        $this->router->post("/auth/login", [LoginController::class, "login"])->name("login");
        $this->router->get("/auth/logout", [LoginController::class, "logout"])->middleware("auth:sanctum")->name("logout");

        $this->router->get("/auth/google/redirect", [SocialiteController::class, "redirectToGoogle"])->name("login.google");
        $this->router->get("/auth/google/callback", [SocialiteController::class, "handleGoogleCallback"]);
        $this->router->get("/auth/facebook/redirect", [SocialiteController::class, "redirectToFacebook"])->name("login.facebook");
        $this->router->get("/auth/facebook/callback", [SocialiteController::class, "handleFacebookCallback"]);
    }
}
