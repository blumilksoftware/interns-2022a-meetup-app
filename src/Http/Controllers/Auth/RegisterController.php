<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\RegisterUserRequest;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function formPage()
    {
        return view("user.register");
    }
    public function create(RegisterUserRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            "name" => $request->get("name"),
            "email" => $request->get("email"),
            "password" => Hash::make($request->get("password")),
        ]);

        return response("User created", 201);
    }
}
