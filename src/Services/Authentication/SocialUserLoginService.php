<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services\Authentication;

use Blumilk\Meetup\Core\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Session\Store;
use Laravel\Socialite\Two\User as SocialUser;

class SocialUserLoginService
{
    public function __construct(
        protected AuthManager $authManager,
        protected Hasher $hasher,
        protected Store $session,
    ) {}

    public function registerOrLogin(SocialUser $socialUser, string $provider): void
    {
        $user = User::query()->firstOrCreate(
            [
                "email" => $socialUser->getEmail(),
            ],
            [
                "name" => $socialUser->getName(),
                "email" => $socialUser->getEmail(),
                "password" => $this->hasher->make($socialUser->getEmail()),
            ],
        );

        $user->socialAccounts()->firstOrCreate([
            "provider_id" => $socialUser->getId(),
            "provider" => $provider,
        ]);

        $this->authManager->login($user);
        $this->session->regenerate();
    }
}
