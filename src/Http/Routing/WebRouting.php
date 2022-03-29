<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Routing;

use Blumilk\Meetup\Core\Http\Controllers\MeetupController;
use Blumilk\Meetup\Core\Http\Controllers\NewsletterSubscriberController;
use Blumilk\Meetup\Core\Http\Controllers\OrganizationController;

class WebRouting extends Routing
{
    public function wire(): void
    {
        $this->router->get("/", fn() => view("welcome"))->name("home");

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

        $this->router->controller(NewsletterSubscriberController::class)->group(function (): void {
            $this->router->get("/newsletter", "create")->name("newsletter");
            $this->router->post("/newsletter", "store")->name("newsletter.store");
        });
    }
}
