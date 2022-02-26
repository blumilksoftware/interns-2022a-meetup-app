<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Routing;

use Blumilk\Meetup\Core\Http\Controllers\MeetupController;

class WebRouting extends Routing
{
    public function wire(): void
    {
        $this->router->get("/", fn() => view("welcome"))->name("home");

        $this->router->get("/meetups", [MeetupController::class, "index"])->name("meetups");
        $this->router->get("/meetups/create", [MeetupController::class, "create"])->name("meetups.create");
        $this->router->post("/meetups", [MeetupController::class, "store"])->name("meetups");
        $this->router->get("/meetups/{meetup}/edit", [MeetupController::class, "edit"])->name("meetups.edit");
        $this->router->put("/meetups/{meetup}", [MeetupController::class, "update"])->name("meetups.update");
        $this->router->delete("/meetups/{meetup}", [MeetupController::class, "destroy"])->name("meetups.destroy");
    }
}
