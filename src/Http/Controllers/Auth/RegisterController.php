<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\RegisterUserRequest;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create(RegisterUserRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "password" => Hash::make($validated["password"]),
        ]);

        return response("User created", 201);
    }
}
