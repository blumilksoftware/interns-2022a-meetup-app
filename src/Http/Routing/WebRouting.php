<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Routing;

use Blumilk\Meetup\Core\Http\Controllers\MeetupController;

class WebRouting extends Routing
{
    public function wire(): void
    {
        $this->router->get("/", fn() => view("welcome"))->name("home");

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
