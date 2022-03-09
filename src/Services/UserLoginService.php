<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Http\Requests\LoginUserRequest;
use Blumilk\Meetup\Core\Models\User;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class UserLoginService
{
    /**
     * @throws AuthenticationException
     */
    public function checkUser(User $user, LoginUserRequest $request): void
    {
        if (!$user || !Hash::check($request->get("password"), $user["password"])) {
            throw new AuthenticationException("Bad credentials");
        }
    }
}

