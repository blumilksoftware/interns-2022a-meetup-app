<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    const google = "google";
    const facebook = "facebook";
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver(self::google)->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        $user = Socialite::driver(self::google)->user();
        $this->registerOrLogin($user, self::google);

        return redirect()->route("home");
    }

    public function redirectToFacebook(): RedirectResponse
    {
        return Socialite::driver(self::facebook)->redirect();
    }

    public function handleFacebookCallback(): RedirectResponse
    {
        $user = Socialite::driver(self::facebook)->user();
        $this->registerOrLogin($user, self::facebook);

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
                "password" => Hash::make($socialUser["email"]),
            ],
        );

        $user->socialAccounts()->firstOrCreate([
            "provider_id" => $socialUser->id,
            "provider" => $provider,
        ]);

        Auth::login($user);
        session()->regenerate();
    }
}
