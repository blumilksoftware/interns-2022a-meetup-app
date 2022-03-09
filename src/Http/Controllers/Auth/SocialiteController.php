<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Models\User;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver("google")->redirect();
    }
    public function handleGoogleCallback(): RedirectResponse
    {
        $user = Socialite::driver("google")->user();

        $this->registerOrLogin($user);

        return redirect()->route("home");
    }
    public function redirectToFacebook(): RedirectResponse
    {
        return Socialite::driver("facebook")->redirect();
    }
    public function handleFacebookCallback(): RedirectResponse
    {
        $user = Socialite::driver("google")->user();

        $this->registerOrLogin($user);

        return redirect()->route("home");
    }

    protected function registerOrLogin($data)
    {
        $user = User::where("email", $data["email"])->first();
        if (!$user) {
            $user = User::create([
                "name" => $data["name"],
                "email" => $data["email"],
                "provider_id" => $data["id"],
            ]);
        }

        $token = $user->createToken($user->email)->plainTextToken;
        $response = [
            "user" => $user["email"],
            "auth_token" => $token,
        ];

        return response($response, 201);
    }
}
