<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Routing;

use Blumilk\Meetup\Core\Http\Controllers\AccountController;
use Blumilk\Meetup\Core\Http\Controllers\AdminController;
use Blumilk\Meetup\Core\Http\Controllers\Auth\EmailVerificationController;
use Blumilk\Meetup\Core\Http\Controllers\Auth\LoginController;
use Blumilk\Meetup\Core\Http\Controllers\Auth\PasswordResetController;
use Blumilk\Meetup\Core\Http\Controllers\Auth\RegisterController;
use Blumilk\Meetup\Core\Http\Controllers\Auth\SocialiteController;
use Blumilk\Meetup\Core\Http\Controllers\ContactController;
use Blumilk\Meetup\Core\Http\Controllers\InvitationController;
use Blumilk\Meetup\Core\Http\Controllers\MeetupController;
use Blumilk\Meetup\Core\Http\Controllers\NewsController;
use Blumilk\Meetup\Core\Http\Controllers\NewsletterSubscriberController;
use Blumilk\Meetup\Core\Http\Controllers\OrganizationController;
use Blumilk\Meetup\Core\Http\Controllers\OrganizationProfileController;
use Blumilk\Meetup\Core\Http\Controllers\SpeakersController;
use Blumilk\Meetup\Core\Http\Controllers\StaticController;
use Blumilk\Meetup\Core\Http\Controllers\UserController;

class WebRouting extends Routing
{
    public function wire(): void
    {
        $this->router->get("/", [MeetupController::class, "index"])->name("home");

        $this->router->controller(RegisterController::class)->middleware("guest")->group(function (): void {
            $this->router->get("/auth/register", "create")->name("register.form");
            $this->router->post("/auth/register", "store")->name("register");
        });

        $this->router->controller(LoginController::class)->group(function (): void {
            $this->router->get("/auth/login", "store")->middleware("guest")->name("login.form");
            $this->router->post("/auth/login", "login")->middleware("guest")->name("login");
            $this->router->get("/auth/logout", "logout")->middleware("auth")->name("logout");
        });

        $this->router->controller(EmailVerificationController::class)->group(function (): void {
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
            $this->router->get("/auth/google/redirect", "redirectToGoogle")->middleware("guest")->name("login.google");
            $this->router->get("/auth/google/callback", "handleGoogleCallback");
            $this->router->get("/auth/facebook/redirect", "redirectToFacebook")->middleware("guest")->name("login.facebook");
            $this->router->get("/auth/facebook/callback", "handleFacebookCallback");
        });

        $this->router->middleware("role:admin")->group(function (): void {
            $this->router->controller(AdminController::class)->group(function (): void {
                $this->router->get("/admin/dashboard", "dashboard")->name("admin.dashboard");
                $this->router->get("/admin/users", "usersIndex")->name("admin.users");
                $this->router->get("/admin/meetups", "meetupsIndex")->name("admin.meetups");
                $this->router->get("/admin/organizations", "organizationsIndex")->name("admin.organizations");
                $this->router->get("/admin/speakers", "speakersIndex")->name("admin.speakers");
                $this->router->get("/admin/news", "newsIndex")->name("admin.news");
            });

            $this->router->controller(UserController::class)->group(function (): void {
                $this->router->delete("/users/{user}", "destroy")->name("users.destroy");
            });

            $this->router->controller(MeetupController::class)->group(function (): void {
                $this->router->get("/meetups", "index")->withoutMiddleware("role:admin")->name("meetups");
                $this->router->get("/meetups/create", "create")->name("meetups.create");
                $this->router->post("/meetups", "store")->name("meetups.store");
                $this->router->get("/meetups/{meetup}/edit", "edit")->name("meetups.edit");
                $this->router->put("/meetups/{meetup}", "update")->name("meetups.update");
                $this->router->delete("/meetups/{meetup}", "destroy")->name("meetups.destroy");
            });

            $this->router->controller(OrganizationController::class)->group(function (): void {
                $this->router->get("/organizations", "index")->withoutMiddleware("role:admin")->name("organizations");
                $this->router->get("/organizations/create", "create")->name("organizations.create");
                $this->router->post("/organizations", "store")->name("organizations.store");
                $this->router->get("/organizations/{organization}/edit", "edit")->name("organizations.edit");
                $this->router->put("/organizations/{organization}", "update")->name("organizations.update");
                $this->router->delete("/organizations/{organization}", "destroy")->name("organizations.destroy");
            });

            $this->router->controller(OrganizationProfileController::class)->group(function (): void {
                $this->router->get("/organizations/{organization}/profiles/create", "create")->name("organizations.profiles.create");
                $this->router->post("/organizations/{organization}/profiles", "store")->name("organizations.profiles.store");
                $this->router->get("/organizations/{organization}/profiles/{profile}/edit", "edit")->name("organizations.profiles.edit");
                $this->router->put("/organizations/{organization}/profiles/{profile}", "update")->name("organizations.profiles.update");
                $this->router->delete("/organizations/{organization}/profiles/{profile}", "destroy")->name("organizations.profiles.destroy");
            });

            $this->router->controller(SpeakersController::class)->group(function (): void {
                $this->router->get("/speakers", "index")->withoutMiddleware("role:admin")->name("speakers");
                $this->router->post("/speakers", "store")->name("speakers.store");
                $this->router->get("/speakers/create", "create")->name("speakers.create");
                $this->router->get("/speakers/{speaker}/edit", "edit")->name("speakers.edit");
                $this->router->put("/speakers/{speaker}", "update")->name("speakers.update");
                $this->router->delete("/speakers/{speaker}", "destroy")->name("speakers.destroy");
            });

            $this->router->controller(NewsController::class)->group(function (): void {
                $this->router->get("/news", "index")->withoutMiddleware("role:admin")->name("news");
                $this->router->get("/news/create", "create")->name("news.create");
                $this->router->post("/news", "store")->name("news.store");
                $this->router->get("/news/{news}/edit", "edit")->name("news.edit");
                $this->router->put("/news/{news}", "update")->name("news.update");
                $this->router->delete("/news/{news}", "destroy")->name("news.destroy");
            });
        });

        $this->router->controller(AccountController::class)->middleware("auth")->group(function (): void {
            $this->router->get("/auth/profile", "index")->name("user.profile");
            $this->router->get("/auth/profile/password", "editPassword")->name("user.profile.password");
            $this->router->get("/auth/profile/edit", "editData")->name("user.profile.edit");
            $this->router->put("/auth/profile/password", "updatePassword")->name("user.profile.password.update");
            $this->router->put("/auth/profile/edit", "updateData")->name("user.profile.update");
        });

        $this->router->controller(ContactController::class)->group(function (): void {
            $this->router->get("/contact", "create")->name("contact");
            $this->router->post("/contact", "store")->name("contact.store");
        });

        $this->router->controller(NewsletterSubscriberController::class)->group(function (): void {
            $this->router->get("/newsletter", "create")->name("newsletter");
            $this->router->post("/newsletter/subscribe", "store")->name("newsletter.store");
            $this->router->get("/newsletter/subscribe/preference", "edit")->name("newsletter.edit");
            $this->router->post("/newsletter/subscribe/preference", "update")->name("newsletter.update");
            $this->router->get("/newsletter/unsubscribe", "delete")->name("newsletter.unsubscribe");
            $this->router->post("/newsletter/unsubscribe", "destroy")->name("newsletter.destroy");
        });

        $this->router->controller(InvitationController::class)->group(function (): void {
            $this->router->get("/invitation", "create")->middleware("auth")->name("invitation");
            $this->router->post("/invitation", "store")->name("invitation.store");
        });

        $this->router->controller(StaticController::class)->group(function (): void {
            $this->router->get("/static/{path}", "index")->where("path", ".*")->name("assets");
        });
    }
}
