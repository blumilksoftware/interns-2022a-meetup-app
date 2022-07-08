<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\Authentication\LoginUserRequest;
use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Services\Authentication\UserLoginService;
use Blumilk\Meetup\Core\Services\User2FaCodesService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class TwoFactorController extends Controller
{
    public function index(Request $request): View
    {
        $email = $request->getSession()->get("email");
//        dd($email);
        return view("user.2fa")
            ->with("email",$email);
    }
    public function login(Request $request, User2FaCodesService $codesService, UserLoginService $loginService): RedirectResponse|View
    {
        $user = User::query()->where("email",$request->get("email"))->first();
        try {
            $codesService->checkCode($user->id,$request->get("code"));
        }catch (AuthenticationException $exception){
            return view("user.2fa")
                ->with([
                    "error"=>$exception->getMessage(),
                    "email"=>$request->get("email"),
                        ]);
        }
        $loginService->loginUser($user);

        return redirect()->route("home");
    }

}
