<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\LoginUserRequest;
use Blumilk\Meetup\Core\Services\UserLoginService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(): View
    {
        return view("user.login");
    }

    public function login(LoginUserRequest $request, UserLoginService $service): View
    {
        $service->loginUser($request->get("email"), $request->get("password"));

        return view("user.dashboard");
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
