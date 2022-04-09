<?php

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\PasswordResetRequest;
use Blumilk\Meetup\Core\Http\Requests\PasswordUpdateRequest;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;
use JetBrains\PhpStorm\NoReturn;


class PasswordResetController extends Controller
{
    public function __construct(
        protected PasswordBrokerManager $passwordBrokerManager,
        protected Hasher $hash
    ){}

    public function create(): View
    {
        return view("user.password.forgot-password");
    }

    public function store(PasswordResetRequest $request): View|RedirectResponse
    {
        $status = $this->passwordBrokerManager->sendResetLink(
            $request->validated()
        );

        return $status === PasswordBroker::RESET_LINK_SENT
            ? \view("user.password.dashboard")->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function edit(string $token): View
    {
        return view('user.password.reset-password')->with('token',$token);
    }

    public function update(PasswordUpdateRequest $request): RedirectResponse|View
    {

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ( $user , $password) {
                $user->forceFill([
                    'password' => $this->hash->make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === PasswordBroker::PASSWORD_RESET
            ? view('user.password.dashboard')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
