<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Exceptions\UserHasTwoFactorException;
use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\Authentication\LoginUserRequest;
use Blumilk\Meetup\Core\Services\Authentication\UserLoginService;
use Blumilk\Meetup\Core\Services\UserTwoFaService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function store(Request $request): View
    {
        $error = $request->session()->get("error");

        return view("user.login")->with("error", $error);
    }

    public function login(LoginUserRequest $request, UserLoginService $loginService, UserTwoFaService $twoFaService): RedirectResponse
    {
        try {
            $loginService->checkUser($request->get("email"), $request->get("password"));
        } catch (AuthenticationException $exception) {
            return back()->with("error", $exception->getMessage());
        } catch (UserHasTwoFactorException $exception) {
            $twoFaService->generateCode($request->get("email"));

            return redirect()->route("twoFa.index")->with("email", $request->get("email"));
        }

        return redirect()->route("home");
    }

    public function logout(Request $request, AuthManager $auth): RedirectResponse
    {
        $auth->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("home");
    }
}
