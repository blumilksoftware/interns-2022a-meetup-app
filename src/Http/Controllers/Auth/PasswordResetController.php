<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Exceptions\PasswordDoesMatchException;
use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\PasswordReset\PasswordResetRequest;
use Blumilk\Meetup\Core\Http\Requests\PasswordReset\PasswordUpdateRequest;
use Blumilk\Meetup\Core\Services\Authentication\PasswordResetService;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PasswordResetController extends Controller
{
    public function __construct(
        protected PasswordBrokerManager $passwordBrokerManager,
        protected Hasher $hash,
    ) {}

    public function create(): View
    {
        return view("user.password.forgot-password");
    }

    public function store(PasswordResetRequest $request): View|RedirectResponse
    {
        $status = $this->passwordBrokerManager->sendResetLink(
            $request->validated(),
        );

        if ($status === PasswordBroker::RESET_LINK_SENT) {
            return view("user.password.dashboard")
                ->with([
                    "status" => __($status),
                    "route" => route("home"),
                    "page" => "home",
                ]);
        }

        return back()->withErrors(["email" => __($status)]);
    }

    public function edit(string $token): View
    {
        $email = request()->get("email");

        return view("user.password.reset-password")->with([
            "token" => $token,
            "email" => $email,
        ]);
    }

    /**
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function update(PasswordUpdateRequest $request, PasswordResetService $service): RedirectResponse|View
    {
        try {
            $service->validatePassword($request->get("password"), $request->get("email"));
        } catch (PasswordDoesMatchException $exception) {
            return view("user.password.reset-password")
                ->with([
                    "error" => $exception->getMessage(),
                    "token" => $request->validated("token"),
                    "email" => $request->validated("email"),
                ]);
        }

        $status = $service->resetPassword($request->validated());

        if ($status === PasswordBroker::PASSWORD_RESET) {
            return view("user.password.dashboard")
                ->with(
                    [
                        "status" => __($status),
                        "route" => route("login"),
                        "page" => "login", ],
                );
        }

        return back()->withErrors(["email" => [__($status)]]);
    }
}
