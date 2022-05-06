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
    ) {}

    public function register(string $email, string $name, string $password): void
    {
        if (!$this->hasher->info($password)["algo"]) {
            $password = $this->hasher->make($password);
        }

        $user = User::query()->firstOrCreate([
            "email" => $email,
            "name" => $name,
            "password" => $password,
        ]);

        event(new Registered($user));
    }
}
