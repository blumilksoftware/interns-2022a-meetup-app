<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Models\User;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver("google")->redirect();
    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver("google")->user();

        $this->registerOrLogin($user);

        return redirect(route("home"));
    }
    public function redirectToFacebook()
    {
        return Socialite::driver("facebook")->redirect();
    }
    public function handleFacebookCallback()
    {
        $user = Socialite::driver("google")->user();

        $this->registerOrLogin($user);

        return redirect(route("home"));
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

        $token = $user->createToken("AccessToken")->plainTextToken;
        $response = [
            "user" => $user["email"],
            "auth_token" => $token,
        ];

        return response($response, 201);
    }
}
