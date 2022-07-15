<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\Account\LoginTwoFaUserCodeRequest;
use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Services\Authentication\UserLoginService;
use Blumilk\Meetup\Core\Services\UsetTwoFaService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    public function index(Request $request): View
    {
        $email = $request->getSession()->get("email");
        return view("user.TwoFa")
            ->with("email", $email);
    }

    public function login(LoginTwoFaUserCodeRequest $request, UsetTwoFaService $codeService, UserLoginService $loginService): RedirectResponse|View
    {
        $user = User::query()->where("email", $request->get("email"))->first();
        try {
            $codeService->checkCode($user->id, (int)$request->get("code"));
        } catch (AuthenticationException $exception) {
            return view("user.TwoFa")
                ->with([
                    "error" => $exception->getMessage(),
                    "email" => $request->get("email"),
                ]);
        }
        $loginService->loginUser($user);

        return redirect()->route("home");
    }
}
