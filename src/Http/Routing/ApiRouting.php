<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Routing;

use Illuminate\Http\Request;

class ApiRouting extends Routing
{
    public function wire(): void
    {
        $this->router->middleware("auth:sanctum")->get("/user", fn(Request $request) => $request->user());
    }
}
