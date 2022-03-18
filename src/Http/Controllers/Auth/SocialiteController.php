<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\AvailableAuthentication as Provider;
use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Services\SocialUserLoginService;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function __construct(SocialUserLoginService $service)
    {
        $this->service = $service;
    }
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver(Provider::GOOGLE)->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        $user = Socialite::driver(Provider::GOOGLE)->user();
        $this->service->registerOrLogin($user, Provider::GOOGLE);

        return redirect()->route("home");
    }

    public function redirectToFacebook(): RedirectResponse
    {
        return Socialite::driver(Provider::FACEBOOK)->redirect();
    }

    public function handleFacebookCallback(SocialUserLoginService $service): RedirectResponse
    {
        $user = Socialite::driver(Provider::FACEBOOK)->user();
        $this->service->registerOrLogin($user, Provider::FACEBOOK);

        return redirect()->route("home");
    }
}
