<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\Authentication\RegisterUserRequest;
use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Services\UserRegisterService;
use Illuminate\Auth\Events\Registered;
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
        $input = $request->validated();
        $input['password'] = $service->register($request->validated("password"));
        $user = User::query()->create($input);
        event(new Registered($user));

        return view("user.registered");
    }
}
