<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Routing;

use Blumilk\Meetup\Core\Http\Controllers\Auth\LoginController;
use Blumilk\Meetup\Core\Http\Controllers\Auth\RegisterController;
use Blumilk\Meetup\Core\Http\Controllers\Auth\SocialiteController;
use Blumilk\Meetup\Core\Http\Controllers\MeetupController;

class WebRouting extends Routing
{
    public function wire(): void
    {
        $this->router->get("/", fn() => view("welcome"))->name("home");

        $this->router->get("/auth/register", [RegisterController::class, "create"])->name("register.form");
        $this->router->post("/auth/register", [RegisterController::class, "store"])->name("register");
        $this->router->get("/auth/login", [LoginController::class, "store"])->name("login.form");
        $this->router->post("/auth/login", [LoginController::class, "login"])->name("login");
        $this->router->get("/auth/logout", [LoginController::class, "logout"])->name("logout")->middleware("auth:sanctum");

        $this->router->controller(SocialiteController::class)->group(function (): void {
            $this->router->get("/auth/google/redirect", [SocialiteController::class, "redirectToGoogle"])->name("login.google");
            $this->router->get("/auth/google/callback", [SocialiteController::class, "handleGoogleCallback"]);
            $this->router->get("/auth/facebook/redirect", [SocialiteController::class, "redirectToFacebook"])->name("login.facebook");
            $this->router->get("/auth/facebook/callback", [SocialiteController::class, "handleFacebookCallback"]);
        });

        $this->router->controller(MeetupController::class)->middleware("auth")->group(function (): void {
            $this->router->get("/meetups", "index")->name("meetups");
            $this->router->get("/meetups/create", "create")->name("meetups.create");
            $this->router->post("/meetups", "store")->name("meetups");
            $this->router->get("/meetups/{meetup}/edit", "edit")->name("meetups.edit");
            $this->router->put("/meetups/{meetup}", "update")->name("meetups.update");
            $this->router->delete("/meetups/{meetup}", "destroy")->name("meetups.destroy");
        });
    }
}

