<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\Authentication\LoginUserRequest;
use Blumilk\Meetup\Core\Services\Authentication\UserLoginService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function store(): View
    {
        return view("user.login");
    }

    public function login(LoginUserRequest $request, UserLoginService $service): RedirectResponse|View
    {
        try {
            $route = $service->checkUser($request->get("email"), $request->get("password"));
        } catch (AuthenticationException $exception) {
            return view("user.login")
                ->with("error", $exception->getMessage());
        }

        return redirect()->route($route)->with(["email" => $request->get("email")]);
    }

    public function logout(Request $request, AuthManager $auth): RedirectResponse
    {
        $auth->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("home");
    }
}
