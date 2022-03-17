<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\User;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserLoginService
{
    public function __construct(Auth $auth, Hasher $hasher)
    {
        $this->auth = $auth;
        $this->hasher = $hasher;
    }
    /**
     * @throws AuthenticationException
     */
    public function loginUser(string $email, string $password): Response
    {
        $user = User::where("email", $email)->first();
        if (!$user || !$this->hasher->check($password, $user->password)) {
            throw new AuthenticationException("Bad credentials");
        }
        $this->auth::login($user);
        session()->regenerate();

        return response($user->email);
    }
}
