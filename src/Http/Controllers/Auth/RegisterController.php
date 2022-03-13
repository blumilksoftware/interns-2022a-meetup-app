<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\RegisterUserRequest;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Contracts\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view("user.register");
    }
    
    public function store(RegisterUserRequest $request, Hasher $hasher): View
    {
        $user = User::create([
            "name" => $request->get("name"),
            "email" => $request->get("email"),
            "password" => $hasher->make($request->get("password")),
        ]);

        return view("user.registered");
    }
}
