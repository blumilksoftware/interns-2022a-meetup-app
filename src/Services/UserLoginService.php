<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\User;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Session\Store;

class UserLoginService
{
    public function __construct(
        public AuthManager $authManager,
        public Hasher $hasher,
        public Store $session,
    ) {}

    /**
     * @throws AuthenticationException
     */
    public function loginUser(string $email, string $password): void
    {
        $user = User::where("email", $email)->first();
        if (!$user || !$this->hasher->check($password, $user->password)) {
            throw new AuthenticationException("Bad credentials");
        }
        $this->authManager->login($user);
        $this->session->regenerate();
    }
}
