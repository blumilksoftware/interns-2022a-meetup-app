<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\Account\User2FaCodeRequest;
use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Services\User2FaCodesService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserSettingsController extends Controller
{
    public function __construct(
        protected AuthManager $authManager,
    ) {}

    public function index(): View
    {
        if ($this->authManager->user()->is_2fa_enable) {
            $twoFactor = true;
        } else {
            $twoFactor = false;
        }

        return view("user.settings")
            ->with("twoFactor", $twoFactor);
    }

    public function enable2Fa(): RedirectResponse
    {
        $user = User::query()->where("email", $this->authManager->user()->email);
        $user->update(["is_2fa_enable" => true]);

        return back();
    }

    public function disable2Fa(User2FaCodesService $codeService): RedirectResponse
    {
        $user = User::query()->where("email", $this->authManager->user()->email)->first();
        $codeService->generateCode($user);

        return redirect()->route("disable2fa.confirm");
    }

    public function disable2FaConfirm(): View
    {
        return view("user.2faDisable");
    }

    public function disable2FaStore(User2FaCodeRequest $request, User2FaCodesService $codesService): RedirectResponse|View
    {
        $user = User::query()->where("email", $this->authManager->user()->email)->first();
        try {
            $codesService->checkCode($user->id, (int)$request->get("code"));
        } catch (AuthenticationException $exception) {
            return view("user.2faDisable")
                ->with("error", $exception->getMessage());
        }
        $user->update(["is_2fa_enable" => false]);

        return redirect()->route("settings");
    }
}
