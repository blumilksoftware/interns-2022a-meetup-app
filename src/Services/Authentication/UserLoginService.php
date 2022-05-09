<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services\Authentication;

use Blumilk\Meetup\Core\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Session\Store;

class UserLoginService
{
    public function __construct(
        protected AuthManager $authManager,
        protected Hasher $hasher,
        protected Store $session,
    ) {}

    /**
     * @throws AuthenticationException
     */
    public function loginUser(string $email, string $password): void
    {
        $user = User::where("email", $email)->first();

        if (!$this->hasher->check($password, $user?->password)) {
            throw new AuthenticationException("Bad credentials");
        }

        $this->authManager->login($user);
        $this->session->regenerate();
    }
}
