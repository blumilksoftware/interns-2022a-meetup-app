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

        $this->router->prefix("/auth")->group(function (): void {
            $this->router->get("/register", [RegisterController::class, "create"])->name("register.form");
            $this->router->post("/register", [RegisterController::class, "store"])->name("register");
            $this->router->get("/login", [LoginController::class, "store"])->name("login.form");
            $this->router->post("/login", [LoginController::class, "login"])->name("login");
            $this->router->get("/logout", [LoginController::class, "logout"])->name("logout")->middleware("auth");

            $this->router->controller(SocialiteController::class)->group(function (): void {
                $this->router->get("/google/redirect", "redirectToGoogle")->name("login.google");
                $this->router->get("/google/callback", "handleGoogleCallback");
                $this->router->get("/facebook/redirect", "redirectToFacebook")->name("login.facebook");
                $this->router->get("/facebook/callback", "handleFacebookCallback");
            });
        });

        $this->router->controller(MeetupController::class)->middleware("auth")->prefix("/meetups")->group(function (): void {
            $this->router->get("/", "index")->name("meetups");
            $this->router->get("/create", "create")->name("meetups.create");
            $this->router->post("/", "store")->name("meetups.store");
            $this->router->get(" / {meetup} / edit", "edit")->name("meetups . edit");
            $this->router->put(" / {meetup}", "update")->name("meetups . update");
            $this->router->delete(" / {meetup}", "destroy")->name("meetups . destroy");
        });

        $this->router->controller(OrganizationController::class)->middleware("auth")->group(function (): void {
            $this->router->get(" / organizations", "index")->name("organizations");
            $this->router->get(" / organizations / create", "create")->name("organizations . create");
            $this->router->post(" / organizations", "store")->name("organizations . store");
            $this->router->get(" / organizations / {organization} / edit", "edit")->name("organizations . edit");
            $this->router->put(" / organizations / {organization}", "update")->name("organizations . update");
            $this->router->delete(" / organizations / {organization}", "destroy")->name("organizations . destroy");
        });
    }
}
