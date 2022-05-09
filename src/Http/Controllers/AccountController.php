<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Contracts\StoreFile;
use Blumilk\Meetup\Core\Exceptions\PasswordIsTheSameAsOldException;
use Blumilk\Meetup\Core\Http\Requests\Account\UpdateUserDataRequest;
use Blumilk\Meetup\Core\Http\Requests\Account\UpdateUserPasswordRequest;
use Blumilk\Meetup\Core\Models\Utils\Constants;
use Blumilk\Meetup\Core\Services\Authentication\ChangePasswordService;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function __construct(
        protected  Guard $auth,
    ) {}

    public function index(): View
    {
//        dd($this->auth->user());
        return view("user.profile.index")->with(["user" => $this->auth->user()]);
    }

    public function editPassword(): View
    {
        return view("user.profile.password");
    }

    public function updatePassword(UpdateUserPasswordRequest $request, ChangePasswordService $service): RedirectResponse|View
    {
        $user = $this->auth->user();

        try {
            $service->validatePassword($request->validated("newPassword"), $user->password);
        } catch (PasswordIsTheSameAsOldException $exception) {
            return view("user.profile.password")
                ->with("error", $exception->getMessage());
        }

        $user->update($request->validated());

        return redirect()->route("user.profile");
    }

    public function editData(): View
    {
        return view("user.profile.edit")
            ->with("user", $this->auth->user());
    }

    public function updateData(UpdateUserDataRequest $request, StoreFile $service): RedirectResponse
    {
        $user = $this->auth->user();
        $input = $request->validated();
        if ($request->hasFile("avatar")) {
            $input["avatar_path"] = $service->storeFile(Constants::USERS_AVATARS_PATH, $request->file("avatar"));
        }
        $user->update($input);

        return redirect()->route("user.profile");
    }
}
