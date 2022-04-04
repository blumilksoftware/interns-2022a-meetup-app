<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Routing;

use Blumilk\Meetup\Core\Http\Controllers\Auth\RegisterController;
use Blumilk\Meetup\Core\Http\Controllers\Auth\SocialiteController;
use Blumilk\Meetup\Core\Http\Controllers\ContactController;
use Blumilk\Meetup\Core\Http\Controllers\MeetupController;
use Blumilk\Meetup\Core\Http\Controllers\NewsController;
use Blumilk\Meetup\Core\Http\Controllers\OrganizationController;
use Blumilk\Meetup\Core\Http\Controllers\SpeakersController;
use Blumilk\Meetup\Core\Http\Controllers\StaticController;

class WebRouting extends Routing
{
    public function wire(): void
    {
        $this->router->get("/", fn() => view("welcome"))->name("home");

        $this->router->controller(RegisterController::class)->group(function (): void {
            $this->router->get("/auth/register", "create")->name("register.form");
            $this->router->post("/auth/register", "store")->name("register");
            $this->router->get("/auth/login", "store")->name("login.form");
            $this->router->post("/auth/login", "login")->name("login");
            $this->router->get("/auth/logout", "logout")->name("logout")->middleware("auth");
        });
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

        $this->router->controller(ContactController::class)->group(function (): void {
            $this->router->get("/contact", "create")->name("contact");
            $this->router->post("/contact", "store")->name("contact.store");
        });

        $this->router->controller(SpeakersController::class)->group(function (): void {
            $this->router->get("/speakers", "index")->name("speakers");
            $this->router->post("/speakers", "store")->name("speakers.store");
            $this->router->get("/speakers/create", "create")->name("speakers.create");
            $this->router->get("/speakers/{speaker}/edit", "edit")->name("speakers.edit");
            $this->router->put("/speakers/{speaker}", "update")->name("speakers.update");
            $this->router->delete("/speakers/{speaker}", "destroy")->name("speakers.destroy");
        });

        $this->router->controller(NewsController::class)->group(function (): void {
            $this->router->get("/news", "index")->name("news");
            $this->router->get("/news/create", "create")->name("news.create");
            $this->router->post("/news", "store")->name("news.store");
            $this->router->get("/news/{news}/edit", "edit")->name("news.edit");
            $this->router->put("/news/{news}", "update")->name("news.update");
            $this->router->delete("/news/{news}", "destroy")->name("news.destroy");
        });

        $this->router->controller(StaticController::class)->group(function (): void {
            $this->router->get("/static/{path}", "index")->where("path", ".*")->name("assets");
        });
    }
}
