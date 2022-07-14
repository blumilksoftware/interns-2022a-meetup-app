<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\Account\Login2FaUserCodeRequest;
use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Services\Authentication\UserLoginService;
use Blumilk\Meetup\Core\Services\User2FaCodesService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    public function index(Request $request): View
    {
        $email = $request->getSession()->get("email");
        return view("user.2fa")
            ->with("email", $email);
    }

    public function login(Login2FaUserCodeRequest $request, User2FaCodesService $codeService, UserLoginService $loginService): RedirectResponse|View
    {
        $user = User::query()->where("email", $request->get("email"))->first();
        try {
            $codeService->checkCode($user->id, $request->get("code"));
        } catch (AuthenticationException $exception) {
            return view("user.2fa")
                ->with([
                    "error" => $exception->getMessage(),
                    "email" => $request->get("email"),
                ]);
        }
        $loginService->loginUser($user);

        return redirect()->route("home");
    }
}
