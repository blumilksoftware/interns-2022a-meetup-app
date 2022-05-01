<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Routing;

use Blumilk\Meetup\Core\Http\Controllers\Auth\LoginController;
use Blumilk\Meetup\Core\Http\Controllers\Auth\PasswordResetController;
use Blumilk\Meetup\Core\Http\Controllers\Auth\RegisterController;
use Blumilk\Meetup\Core\Http\Controllers\Auth\SocialiteController;
use Blumilk\Meetup\Core\Http\Controllers\ContactController;
use Blumilk\Meetup\Core\Http\Controllers\MeetupController;
use Blumilk\Meetup\Core\Http\Controllers\NewsController;
use Blumilk\Meetup\Core\Http\Controllers\NewsletterSubscriberController;
use Blumilk\Meetup\Core\Http\Controllers\OrganizationController;
use Blumilk\Meetup\Core\Http\Controllers\OrganizationProfileController;
use Blumilk\Meetup\Core\Http\Controllers\SpeakersController;
use Blumilk\Meetup\Core\Http\Controllers\StaticController;
use Illuminate\View\View;

class WebRouting extends Routing
{
    public function wire(): void
    {
        $this->router->get("/", fn(): View => view("home"))->name("home");

        $this->router->controller(RegisterController::class)->group(function (): void {
            $this->router->get("/auth/register", "create")->name("register.form");
            $this->router->post("/auth/register", "store")->name("register");
        });

        $this->router->controller(LoginController::class)->group(function (): void {
            $this->router->get("/auth/login", "store")->name("login.form");
            $this->router->post("/auth/login", "login")->name("login");
            $this->router->get("/auth/logout", "logout")->name("logout")->middleware("auth");
        });

        $this->router->controller(PasswordResetController::class)->group(function (): void {
            $this->router->get("/email/verify", "create")->middleware("auth")->name("verification.notice");
            $this->router->get("/email/verify/{id}/{hash}", "store")->middleware(["auth", "signed"])->name("verification.verify");
            $this->router->post("/email/verification-notification", "notification")->middleware(["auth", "throttle:web"])->name("verification.send");
        });

        $this->router->controller(PasswordResetController::class)->group(function (): void {
            $this->router->get("/auth/forgot-password", "create")->name("password.request");
            $this->router->post("/auth/forgot-password", "store")->name("password.email");
            $this->router->get("/auth/reset-password/{token}", "edit")->name("password.reset");
            $this->router->post("/auth/reset-password", "update")->name("password.update");
        });

        $this->router->controller(SocialiteController::class)->group(function (): void {
            $this->router->get("/auth/google/redirect", "redirectToGoogle")->name("login.google");
            $this->router->get("/auth/google/callback", "handleGoogleCallback");
            $this->router->get("/auth/facebook/redirect", "redirectToFacebook")->name("login.facebook");
            $this->router->get("/auth/facebook/callback", "handleFacebookCallback");
        });

        $this->router->controller(MeetupController::class)->middleware("auth")->group(function (): void {
            $this->router->get("/", "index")->name("meetups");
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

        $this->router->controller(OrganizationProfileController::class)->middleware("auth")->group(function (): void {
            $this->router->get("/organizations/{organization}/profiles/create", "create")->name("organizations.profiles.create");
            $this->router->post("/organizations/{organization}/profiles", "store")->name("organizations.profiles.store");
            $this->router->get("/organizations/{organization}/profiles/{profile}/edit", "edit")->name("organizations.profiles.edit");
            $this->router->put("/organizations/{organization}/profiles/{profile}", "update")->name("organizations.profiles.update");
            $this->router->delete("/organizations/{organization}/profiles/{profile}", "destroy")->name("organizations.profiles.destroy");
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
            $this->router->get("/news/create", "create")->middleware("auth")->name("news.create");
            $this->router->post("/news", "store")->name("news.store");
            $this->router->get("/news/{news}/edit", "edit")->middleware("auth")->name("news.edit");
            $this->router->put("/news/{news}", "update")->middleware("auth")->name("news.update");
            $this->router->delete("/news/{news}", "destroy")->middleware("auth")->name("news.destroy");
        });

        $this->router->controller(NewsletterSubscriberController::class)->group(function (): void {
            $this->router->get("/newsletter", "create")->name("newsletter");
            $this->router->post("/newsletter/subscribe", "store")->name("newsletter.store");
            $this->router->get("/newsletter/subscribe/preference", "edit")->name("newsletter.edit");
            $this->router->post("/newsletter/subscribe/preference", "update")->name("newsletter.update");
            $this->router->post("/newsletter/unsubscribe", "destroy")->name("newsletter.destroy");
        });

        $this->router->controller(StaticController::class)->group(function (): void {
            $this->router->get("/static/{path}", "index")->where("path", ".*")->name("assets");
        });
    }
}
