<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Contracts\StoreFile;
use Blumilk\Meetup\Core\Enums\AvailableGenders;
use Blumilk\Meetup\Core\Exceptions\PasswordIsTheSameAsOldException;
use Blumilk\Meetup\Core\Http\Requests\Account\UpdateUserDataRequest;
use Blumilk\Meetup\Core\Http\Requests\Account\UpdateUserPasswordRequest;
use Blumilk\Meetup\Core\Models\Utils\Constants;
use Blumilk\Meetup\Core\Services\Authentication\ChangePasswordService;
use Blumilk\Meetup\Core\Services\UserProfileService;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\LaravelOptions\Options;

class AccountController extends Controller
{
    public function __construct(
        protected  Guard $auth,
    ) {}

    public function index(): View
    {
        return view("user.profile.index")
            ->with("user", $this->auth->user());
    }

    public function editPassword(): View
    {
        return view("user.profile.password");
    }

    public function updatePassword(UpdateUserPasswordRequest $request, ChangePasswordService $service): RedirectResponse|View
    {
        $user = $this->auth->user();

        try {
            $service->validatePassword($request->validated("new_password"), $user->password);
        } catch (PasswordIsTheSameAsOldException $exception) {
            return view("user.profile.password")
                ->with("error", $exception->getMessage());
        }

        $input = $request->validated();
        $input["password"] = $service->hashPassword($request->validated("new_password"));

        $user->update($input);

        return redirect()->route("user.profile");
    }

    public function editData(): View
    {
        return view("user.profile.edit")
            ->with([
                "user" => $this->auth->user(),
                "genders" => Options::forEnum(AvailableGenders::class)->toArray(),
            ]);
    }

    public function updateData(UpdateUserDataRequest $request, StoreFile $service, UserProfileService $userProfileService): RedirectResponse
    {
        $profileData = $request->profileData();

        if ($request->hasFile("avatar")) {
            $profileData["avatar_path"] = $service->storeFile(Constants::USERS_AVATARS_PATH, $request->file("avatar"));
        }

        $userProfileService->update($request->user(), $request->userData(), $profileData);

        return redirect()->route("user.profile");
    }
}
