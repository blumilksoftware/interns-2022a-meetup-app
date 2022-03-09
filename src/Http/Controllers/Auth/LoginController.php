<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\LoginUserRequest;
use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Services\UserLoginService;
use Illuminate\Http\Response;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function store()
    {
        return view("user.login");
    }
    public function login(LoginUserRequest $request): Response
    {
        $validated = $request->validated();
        $user = User::where("email", $validated["email"])->first();
        $service = new UserLoginService();
        $service->checkUser($user, $request);

        $token = $user->createToken($user->email)->plainTextToken;
        $data = [
            "user" => $user["email"],
            "auth_token" => $token,
        ];

        return response()
            ->view("user.dashboard")
            ->header("BearerToken", $data["auth_token"]);
    }

    public function logout(): View
    {
        auth()->user()->tokens()->delete();

        return view("user.logout");
    }
}
