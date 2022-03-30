<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Routing;

use Blumilk\Meetup\Core\Http\Controllers\Auth\LoginController;
use Blumilk\Meetup\Core\Http\Controllers\Auth\RegisterController;
use Blumilk\Meetup\Core\Http\Controllers\Auth\SocialiteController;
use Blumilk\Meetup\Core\Http\Controllers\MeetupController;
use Blumilk\Meetup\Core\Http\Controllers\OrganizationController;

class WebRouting extends Routing
{
    public function wire(): void
    {
        $this->router->get("/", fn() => view("welcome"))->name("home");

        $this->router->get("/auth/register", [RegisterController::class, "create"])->name("register.form");
        $this->router->post("/auth/register", [RegisterController::class, "store"])->name("register");
        $this->router->get("/auth/login", [LoginController::class, "store"])->name("login.form");
        $this->router->post("/auth/login", [LoginController::class, "login"])->name("login");
        $this->router->get("/auth/logout", [LoginController::class, "logout"])->name("logout")->middleware("auth");

        $this->router->controller(SocialiteController::class)->group(function (): void {
            $this->router->get("/auth/google/redirect", "redirectToGoogle")->name("login.google");
            $this->router->get("/auth/google/callback", "handleGoogleCallback");
            $this->router->get("/auth/facebook/redirect", "redirectToFacebook")->name("login.facebook");
            $this->router->get("/auth/facebook/callback", "handleFacebookCallback");
        });

        $this->router->controller(MeetupController::class)->middleware("auth")->group(function (): void {
            $this->router->get("/meetups", "index")->name("meetups");
            $this->router->get("/meetups/create", "create")->name("meetups.create");
            $this->router->post("/meetups", "store")->name("meetups.store");
            $this->router->get("/meetups/{meetup}/edit", "edit")->name("meetups.edit");
            $this->router->put("/meetups/{meetup}", "update")->name("meetups.update");
            $this->router->delete("/meetups/{meetup}", "destroy")->name("meetups.destroy");
        });

        $this->router->controller(OrganizationController::class)->middleware("auth")->group(function (): void {
            $this->router->get("/organizations", "index")->name("organizations");
            $this->router->get("/organizations/create", "create")->name("organizations.create");
            $this->router->post("/organizations", "store")->name("organizations.store");
            $this->router->get("/organizations/{organization}/edit", "edit")->name("organizations.edit");
            $this->router->put("/organizations/{organization}", "update")->name("organizations.update");
            $this->router->delete("/organizations/{organization}", "destroy")->name("organizations.destroy");
        });
    }
}
