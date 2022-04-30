<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services\Authentication;

use Blumilk\Meetup\Core\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Str;

class PasswordResetService
{
    public function __construct(
        protected PasswordBrokerManager $password,
        protected Hasher $hash,
    ) {}

    /**
     * @throws AuthenticationException
     */
    public function validatePassword(string $password, string $email): void
    {
        $user = User::query()->where("email", $email)->first();

        if ($this->hash->check($password, $user?->password)) {
            throw new AuthenticationException("New password cannot be the same as the old password");
        }
    }

    /**
     * @throws AuthenticationException
     */
    public function resetPassword(array $request): mixed
    {
        return $this->password->reset(
            $request,
            function ($user, $password): void {
                $user->forceFill([
                    "password" => $this->hash->make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();
            },
        );
    }
}
