<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\Account\UserTwoFaCodeRequest;
use Blumilk\Meetup\Core\Services\UserTwoFaService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserSettingsController extends Controller
{
    public function __construct(
        protected AuthManager $authManager,
    ) {}

    public function index(): View
    {
        if ($this->authManager->user()->hasTwoFaEnable) {
            $twoFactor = true;
        } else {
            $twoFactor = false;
        }

        return view("user.settings")
            ->with("twoFactor", $twoFactor);
    }

    public function enableTwoFa(): RedirectResponse
    {
        $user = $this->authManager->user();
        $user->update(["has_two_fa_enable" => true]);

        return back();
    }

    public function disableTwoFa(UserTwoFaService $codeService): RedirectResponse
    {
        $user = $this->authManager->user();
        $codeService->generateCode($user->email);

        return redirect()->route("disableTwoFa.confirm");
    }

    public function disableTwoFaConfirm(Request $request): View
    {
        $error = $request->getSession()->get("error");
        return view("user.twoFaDisable")
            ->with("error", $error);
    }

    public function disableTwoFaStore(UserTwoFaCodeRequest $request, UserTwoFaService $twoFaCodesService): RedirectResponse|View
    {
        $user = $this->authManager->user();

        try {
            $twoFaCodesService->checkCode($user->id, (int)$request->get("code"));
        } catch (AuthenticationException $exception) {
            return back()->with("error", $exception->getMessage());
        }

        $user->update(["has_two_fa_enable" => false]);

        return redirect()->route("settings");
    }
}
