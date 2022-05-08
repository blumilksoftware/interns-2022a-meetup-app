<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Contracts\StoreFile;
use Blumilk\Meetup\Core\Exceptions\PasswordIsTheSameAsOldException;
use Blumilk\Meetup\Core\Exceptions\PasswordIsNotTheSameAsOldException;
use Blumilk\Meetup\Core\Http\Requests\UpdateUserDataRequest;
use Blumilk\Meetup\Core\Http\Requests\UpdateUserPasswordRequest;
use Blumilk\Meetup\Core\Models\Utils\Constants;
use Blumilk\Meetup\Core\Services\Authentication\ChangePasswordService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view("user.profile.index")->with(["user" => Auth::user()]);
    }

    public function editPassword(): View
    {
        return view("user.profile.password");
    }

    public function updatePassword(UpdateUserPasswordRequest $request, ChangePasswordService $service): RedirectResponse|View
    {
        $user = Auth::user();

        try {
            $service->currentPassword($request->validated("password"), $user->password);
            $service->validatePassword($request->validated("newPassword"), $user->password);
        } catch (PasswordIsNotTheSameAsOldException|PasswordIsTheSameAsOldException $exception) {
            return view("user.profile.password")
                ->with("error", $exception->getMessage());
        }

        $user->update($request->validated());

        return redirect()->route("user.profile");
    }

    public function editData(): View
    {
        return view("user.profile.edit")
            ->with("user", Auth::user());
    }

    public function updateData(UpdateUserDataRequest $request, StoreFile $service): RedirectResponse
    {
        $user = Auth::user();
        $input = $request->validated();
        if ($request->hasFile("avatar")) {
            $input["avatar_path"] = $service->storeFile(Constants::USERS_AVATARS_PATH, $request->file("avatar"));
        }

        $user->update($input);

        return redirect()->route("user.profile");
    }
}
