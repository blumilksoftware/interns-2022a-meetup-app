<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Http\Requests\PasswordResetRequest;
use Blumilk\Meetup\Core\Http\Requests\PasswordUpdateRequest;
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

        if ($status === PasswordBroker::RESET_LINK_SENT)
        {
            return view("user.password.dashboard")->with(["status" => __($status)]);
        }
            return back()->withErrors(["email" => __($status)]);
    }

    public function edit(string $token): View
    {
        return view("user.password.reset-password")->with("token", $token);
    }

    /**
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function update(PasswordUpdateRequest $request, PasswordResetService $service): RedirectResponse|View
    {
        $status = $service->resetPassword($request->validated());

        if ($status === PasswordBroker::PASSWORD_RESET){
            return view("user.password.dashboard")->with("status", __($status));
        }
            return back()->withErrors(["email" => [__($status)]]);
    }
}
