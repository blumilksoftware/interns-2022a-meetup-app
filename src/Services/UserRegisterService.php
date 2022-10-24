<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Hashing\Hasher;

class UserRegisterService
{
    public function __construct(
        protected Hasher $hasher,
        protected UserProfileService $userProfileService,
    ) {}

    public function register(string $email, string $name, string $password): void
    {
        $hashedPassword = $this->hasher->make($password);

        $user = User::query()->firstOrCreate([
            "email" => $email,
            "name" => $name,
            "password" => $hashedPassword,
        ]);

        $this->userProfileService->create($user);

        event(new Registered($user));
    }
}
