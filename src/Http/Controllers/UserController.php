<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Models\User;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return back();
    }
}
