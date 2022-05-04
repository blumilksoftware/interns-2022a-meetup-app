<?php

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Contracts\StoreFile;
use Blumilk\Meetup\Core\Http\Requests\UpdateUserAccountRequest;
use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Models\Utils\Constants;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view("user.profile.index")->with(["user"=>Auth::user()]);
    }
    public function edit(): View
    {
        return view("user.profile.edit")
            ->with("user", Auth::user());

    }
    public function update(UpdateUserAccountRequest $request, StoreFile $service, User $user): RedirectResponse
    {
        $input = $request->validated();

        if ($request->hasFile("avatar")) {
            $input["avatar_path"] = $service->storeFile(Constants::USERS_AVATARS_PATH, $request->file("avatar"));
        }

        $user->update($input);

        return redirect()->route("user.profile");
    }
}
