<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers\Auth;

use Blumilk\Meetup\Core\Http\Controllers\Controller;
use Blumilk\Meetup\Core\Services\Authentication\AvailableAuthentication as Provider;
use Blumilk\Meetup\Core\Services\Authentication\SocialUserLoginService;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function __construct(
        protected SocialUserLoginService $service,
    ) {}

    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver(Provider::GOOGLE->value)->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        $user = Socialite::driver(Provider::GOOGLE->value)->user();
        $this->service->registerOrLogin($user, Provider::GOOGLE->value);

        return redirect()->route("home");
    }

    public function redirectToFacebook(): RedirectResponse
    {
        return Socialite::driver(Provider::FACEBOOK->value)->redirect();
    }

    public function handleFacebookCallback(SocialUserLoginService $service): RedirectResponse
    {
        $user = Socialite::driver(Provider::FACEBOOK->value)->user();
        $this->service->registerOrLogin($user, Provider::FACEBOOK->value);

        return redirect()->route("home");
    }
}
