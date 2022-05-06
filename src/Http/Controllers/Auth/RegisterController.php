<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\Authentication\RegisterUserRequest;
use Blumilk\Meetup\Core\Services\UserRegisterService;
use Illuminate\Contracts\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        if (request()->has("email")) {
            return view("user.register")->with("email", request()->get("email"));
        }

        return view("user.register")->with("email", old("email"));
    }

    public function store(RegisterUserRequest $request, UserRegisterService $service): View
    {
        $service->register($request->validated("email"), $request->validated("name"), $request->validated("password"), );

        return view("user.registered");
    }
}
