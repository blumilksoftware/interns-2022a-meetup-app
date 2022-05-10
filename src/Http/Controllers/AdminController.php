<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Models\Meetup;
use Blumilk\Meetup\Core\Models\News;
use Blumilk\Meetup\Core\Models\Organization;
use Blumilk\Meetup\Core\Models\Speaker;
use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Models\Utils\Constants;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        return view("admin.dashboard");
    }

    public function usersIndex(): View
    {
        $users = User::query()->latest()->paginate(Constants::DEFAULT_PAGINATION);

        return view("admin.users")
            ->with("users", $users);
    }

    public function meetupsIndex(): View
    {
        $meetups = Meetup::query()->latest()->paginate(Constants::DEFAULT_PAGINATION);

        return view("admin.meetups")
            ->with("meetups", $meetups);
    }

    public function organizationsIndex(): View
    {
        $organizations = Organization::query()->latest()->paginate(Constants::DEFAULT_PAGINATION);

        return view("admin.organizations")
            ->with("organizations", $organizations);
    }

    public function speakersIndex(): View
    {
        $speakers = Speaker::query()->latest()->paginate(Constants::DEFAULT_PAGINATION);

        return view("admin.speakers")
            ->with("speakers", $speakers);
    }

    public function newsIndex(): View
    {
        $news = News::query()->latest()->paginate(Constants::DEFAULT_PAGINATION);

        return view("admin.news")
            ->with("news", $news);
    }
}
