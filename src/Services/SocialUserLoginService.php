<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\User;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Session\Store;

class SocialUserLoginService
{
    public function __construct(AuthManager $auth, Hasher $hasher, Store $session)
    {
        $this->auth = $auth;
        $this->hasher = $hasher;
        $this->session = $session;
    }
    /**
     * @throws AuthenticationException
     */
    public function registerOrLogin($socialUser, string $provider): void
    {
        $appUser = User::query()->firstOrCreate(
            [
                "email" => $socialUser["email"],
            ],
            [
                "name" => $socialUser["name"],
                "email" => $socialUser["email"],
                "password" => $this->hasher->make($socialUser["email"]),
            ],
        );
        if (!$appUser->id) {
            $appUser = User::query()->where("email", $appUser->getAttribute("email"))->first();
        }
        $appUser->socialAccounts()->firstOrCreate([
            "provider_id" => $socialUser->id,
            "provider" => $provider,
        ]);

        $this->auth->login($appUser);
        $this->session->regenerate();
    }
}
