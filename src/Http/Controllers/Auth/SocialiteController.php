<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\AvailableAuthentication as Provider;
use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function __construct(Auth $auth, Hasher $hasher)
    {
        $this->auth = $auth;
        $this->hasher = $hasher;
    }
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver(Provider::GOOGLE)->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        $user = Socialite::driver(Provider::GOOGLE)->user();
        $this->registerOrLogin($user, Provider::GOOGLE);

        return redirect()->route("home");
    }

    public function redirectToFacebook(): RedirectResponse
    {
        return Socialite::driver(Provider::FACEBOOK)->redirect();
    }

    public function handleFacebookCallback(): RedirectResponse
    {
        $user = Socialite::driver(Provider::FACEBOOK)->user();
        $this->registerOrLogin($user, Provider::FACEBOOK);

        return redirect()->route("home");
    }

    protected function registerOrLogin($socialUser, string $provider): void
    {
        $user = User::firstOrCreate(
            [
                "email" => $socialUser["email"],
            ],
            [
                "name" => $socialUser["name"],
                "email" => $socialUser["email"],
                "password" => $this->hasher->make($socialUser["email"]),
            ],
        );

        $user->socialAccounts()->firstOrCreate([
            "provider_id" => $socialUser->id,
            "provider" => $provider,
        ]);

        $this->auth::login($user);
        session()->regenerate();
    }
}
