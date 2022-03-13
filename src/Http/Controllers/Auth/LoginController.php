<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\LoginUserRequest;
use Blumilk\Meetup\Core\Services\UserLoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function store()
    {
        return view("user.login");
    }
    public function login(LoginUserRequest $request): \Illuminate\Contracts\View\View
    {
        $service = new UserLoginService();
        $data = [
            "email" => $request->get("email"),
            "password" => $request->get("password"),
        ];
        $service->loginUser($data);

        return \view("user.dashboard");
    }

    public function logout(Request $request): View
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->forget("user");

        return view("user.logout");
    }
}
