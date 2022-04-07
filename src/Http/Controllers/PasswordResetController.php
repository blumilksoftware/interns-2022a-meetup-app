<?php

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\PasswordResetRequest;
use Blumilk\Meetup\Core\Http\Requests\PasswordUpdateRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;


class PasswordResetController extends Controller
{
    public function __construct(protected PasswordBrokerManager $passwordBrokerManager, protected Hasher $hash){

    }
    public function create(): View
    {
        return view("user.forgot-password");
    }

    public function store(PasswordResetRequest $request): RedirectResponse
    {
        $status = $this->passwordBrokerManager->sendResetLink(
            $request->validated()
        );

        return $status === PasswordBroker::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function edit(string $token): View
    {
        return view('user.reset-password')->with('token',$token);
    }

    public function update(PasswordUpdateRequest $request):RedirectResponse
    {
        $status = $this->passwordBrokerManager->reset(
            $request->validated(),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $this->hash->make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === PasswordBroker::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
