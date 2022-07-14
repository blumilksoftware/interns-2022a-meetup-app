<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services\Authentication;

use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Notifications\TwoStepVerificationNotification;
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
    public function checkUser(string $email, string $password): string
    {
        $user = User::query()->where("email", $email)->first();

        if (!$this->hasher->check($password, $user?->password)) {
            throw new AuthenticationException("Bad credentials");
        }
        if ($user->get("is2FaEnable")) {
            $this->generateCode($user);
            return "2fa.index";
        }  
        $this->loginUser($user);
        return "home";
    }

    public function generateCode(User $user): void
    {
        $code = rand(100000, 999999);

        $user->code()->updateOrCreate(
            ["user_id" => $user->id],
            ["code" => $code],
        );
        $user->notify(new TwoStepVerificationNotification($user, $code));
    }

    public function loginUser(User $user): void
    {
        $this->authManager->login($user);
        $this->session->regenerate();
    }
}
