<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\Meetup\StoreMeetupRequest;
use Blumilk\Meetup\Core\Http\Requests\Meetup\UpdateMeetupRequest;
use Blumilk\Meetup\Core\Models\Meetup;
use Blumilk\Meetup\Core\Models\Utils\Constants;
use Blumilk\Meetup\Core\Services\StoreFileService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MeetupController extends Controller
{
    public function index(): View
    {
        $meetups = Meetup::query()->latest()->with(["user"])->paginate(20);

        return view("meetups.index")
            ->with("meetups", $meetups);
    }

    public function create(): View
    {
        return view("meetups.create");
    }

    public function store(StoreMeetupRequest $request, StoreFileService $service): RedirectResponse
    {
        $input = $request->validated();
        $input["logo"] = $service->storeFile(Constants::MEETUPS_LOGOS_PATH, $request->file("logo"));

        $request->user()->meetups()->create($input);

        return redirect()->route("meetups");
    }

    public function edit(Meetup $meetup): View
    {
        return view("meetups.edit")
            ->with("meetup", $meetup);
    }

    public function update(UpdateMeetupRequest $request, Meetup $meetup, StoreFileService $service): RedirectResponse
    {
        $input = $request->validated();
        if ($request->hasFile("logo")) {
            $input["logo"] = $service->storeFile(Constants::MEETUPS_LOGOS_PATH, $request->file("logo"));
        }

        $meetup->update($input);

        return redirect()->route("meetups");
    }

    public function destroy(Meetup $meetup): RedirectResponse
    {
        $meetup->delete();

        return back();
    }
}
