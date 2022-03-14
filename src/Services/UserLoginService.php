<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\User;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserLoginService
{
    /**
     * @throws AuthenticationException
     */
    public function loginUser(string $email, string $password): Response
    {
        $user = User::where("email", $email)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            throw new AuthenticationException("Bad credentials");
        }
        Auth::login($user);
        session()->regenerate();

        return response($user->email);
    }
}
