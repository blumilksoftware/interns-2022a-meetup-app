<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Contracts\StoreFile;
use Blumilk\Meetup\Core\Exceptions\PasswordDoesMatchException;
use Blumilk\Meetup\Core\Exceptions\PasswordDoesNotMatchException;
use Blumilk\Meetup\Core\Http\Requests\UpdateUserAvatarRequest;
use Blumilk\Meetup\Core\Http\Requests\UpdateUserEmailRequest;
use Blumilk\Meetup\Core\Http\Requests\UpdateUserNameRequest;
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

    public function editName(): View
    {
        return view("user.profile.name")
            ->with("user", Auth::user());
    }

    public function updateName(UpdateUserNameRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $user->update($request->validated());

        return redirect()->route("user.profile");
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
        } catch (PasswordDoesNotMatchException|PasswordDoesMatchException $exception) {
            return view("user.profile.password")
                ->with("error", $exception->getMessage());
        }

        $user->update($request->validated());

        return redirect()->route("user.profile");
    }

    public function editAvatar(): View
    {
        return view("user.profile.avatar")
            ->with("user", Auth::user());
    }

    public function updateAvatar(UpdateUserAvatarRequest $request, StoreFile $service): RedirectResponse
    {
        $user = Auth::user();
        $input = $request->validated();
        if ($request->hasFile("avatar")) {
            $input["avatar_path"] = $service->storeFile(Constants::USERS_AVATARS_PATH, $request->file("avatar"));
        }

        $user->update($input);

        return redirect()->route("user.profile");
    }

    public function editEmail(): View
    {
        return view("user.profile.email")
            ->with("user", Auth::user());
    }

    public function updateEmail(UpdateUserEmailRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $user->update($request->validated());

        return redirect()->route("user.profile");
    }
}
