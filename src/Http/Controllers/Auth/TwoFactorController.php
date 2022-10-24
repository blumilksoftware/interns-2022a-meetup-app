<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\Account\LoginTwoFaUserCodeRequest;
use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Services\Authentication\UserLoginService;
use Blumilk\Meetup\Core\Services\UserTwoFaService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TwoFactorController extends Controller
{
    public function index(Request $request): View
    {
        $email = $request->getSession()->get("email");
        $error = $request->getSession()->get("error");

        return view("user.twoFa")
            ->with([
                "email" => $email,
                "error" => $error,
            ]);
    }

    public function login(LoginTwoFaUserCodeRequest $request, UserTwoFaService $codeService, UserLoginService $loginService): RedirectResponse
    {
        Session::put("email", $request->get("email"));
        $user = User::query()->where("email", $request->get("email"))->first();

        try {
            $codeService->checkCode($user->id, (int)$request->get("code"));
        } catch (AuthenticationException $exception) {
            return back()
                ->with([
                    "error" => $exception->getMessage(),
                    "email" => $request->get("email"),
                ]);
        }

        $loginService->loginUser($user);

        return redirect()->route("home");
    }
}
