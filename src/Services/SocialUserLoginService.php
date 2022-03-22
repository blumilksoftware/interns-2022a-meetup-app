<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Session\Store;

class SocialUserLoginService
{
    public function __construct(
        protected AuthManager $authManager,
        protected Hasher $hasher,
        protected Store $session,
    ) {}

    public function registerOrLogin(string $socialEmail, string $socialName, string $socialId, string $provider): void
    {
        $user = User::query()->firstOrCreate(
            [
                "email" => $socialEmail,
            ],
            [
                "name" => $socialName,
                "email" => $socialEmail,
                "password" => $this->hasher->make($socialEmail),
            ],
        );

        if (!$user->id) {
            $user = User::query()->where("email", $user->email)->first();
        }

        $user->socialAccounts()->firstOrCreate([
            "provider_id" => $socialId,
            "provider" => $provider,
        ]);

        $this->authManager->login($user);
        $this->session->regenerate();
    }
}
