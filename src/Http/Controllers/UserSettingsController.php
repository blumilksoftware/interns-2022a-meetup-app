<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\Account\UserTwoFaCodeRequest;
use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Services\UsetTwoFaService;
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
        if ($this->authManager->user()->isTwoFaEnable) {
            $twoFactor = true;
        } else {
            $twoFactor = false;
        }

        return view("user.settings")
            ->with("twoFactor", $twoFactor);
    }

    public function enableTwoFa(): RedirectResponse
    {
        $user = User::query()->where("email", $this->authManager->user()->email);
        $user->update(["is_two_fa_enable" => true]);

        return back();
    }

    public function disableTwoFa(UsetTwoFaService $codeService): RedirectResponse
    {
        $user = User::query()->where("email", $this->authManager->user()->email)->first();
        $codeService->generateCode($user);

        return redirect()->route("disableTwoFa.confirm");
    }

    public function disableTwoFaConfirm(): View
    {
        return view("user.TwoFaDisable");
    }

    public function disableTwoFaStore(UserTwoFaCodeRequest $request, UsetTwoFaService $twoFaCodesService): RedirectResponse|View
    {
        $user = User::query()->where("email", $this->authManager->user()->email)->first();
        try {
            $twoFaCodesService->checkCode($user->id, (int)$request->get("code"));
        } catch (AuthenticationException $exception) {
            return view("user.TwoFaDisable")
                ->with("error", $exception->getMessage());
        }
        $user->update(["is_two_fa_enable" => false]);

        return redirect()->route("settings");
    }
}
