<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\Authentication\RegisterUserRequest;
use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Models\Utils\Constants;
use Blumilk\Meetup\Core\Services\StoreFileService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view("user.register");
    }

    public function store(RegisterUserRequest $request, StoreFileService $service): View
    {
        $user = User::query()->create($request->validated());
        event(new Registered($user));

        return view("user.registered");
    }
}
