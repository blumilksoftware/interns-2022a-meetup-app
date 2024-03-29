<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\Invitations\StoreInvitationRequest;
use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Services\InvitationsService;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class InvitationController extends Controller
{
    public function create(): View
    {
        return view("invitation");
    }

    public function store(StoreInvitationRequest $request, InvitationsService $service, Guard $auth): RedirectResponse
    {
        if (User::query()->where("email", $request->validated("email"))->exists()) {
            return back()->with("message", "User with that email already existed");
        }

        $service->sendInvitation($auth->user(), $request->validated("email"));

        return back()->with("message", "We have sent invitation");
    }
}
