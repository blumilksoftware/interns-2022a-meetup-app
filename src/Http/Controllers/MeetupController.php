<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\Meetup\StoreMeetupRequest;
use Blumilk\Meetup\Core\Http\Requests\Meetup\UpdateMeetupRequest;
use Blumilk\Meetup\Core\Models\Meetup;
use Blumilk\Meetup\Core\Models\Organization;
use Blumilk\Meetup\Core\Models\Speaker;
use Blumilk\Meetup\Core\Models\Utils\Constants;
use Blumilk\Meetup\Core\Services\StoreFileService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MeetupController extends Controller
{
    public function index(): View
    {
        $meetups = Meetup::query()->latest()->with(["user"])->paginate(20);

        return view("home")
            ->with("meetups", $meetups);
    }

    public function create(): View
    {
        return view("meetups.create")
            ->with([
                "organizations" => Organization::query()->orderBy("name")->get(),
                "speakers" => Speaker::query()->orderBy("name")->get(),
            ]);
    }

    public function store(StoreMeetupRequest $request, StoreFileService $service): RedirectResponse
    {
        $input = $request->validated();
        if ($request->hasFile("logo")) {
            $input["logo_path"] = $service->storeFile(Constants::MEETUPS_LOGOS_PATH, $request->file("logo"));
        }

        $meetup = $request->user()->meetups()->create($input);

        if ($request->has("speakers")) {
            $meetup->speakers()->attach($input["speakers"]);
        }

        return redirect()->route("meetups");
    }

    public function edit(Meetup $meetup): View
    {
        return view("meetups.edit")
            ->with([
                "meetup" => $meetup,
                "organizations" => Organization::query()->orderBy("name")->get(),
                "speakers" => Speaker::query()->orderBy("name")->get(),
            ]);
    }

    public function update(UpdateMeetupRequest $request, Meetup $meetup, StoreFileService $service): RedirectResponse
    {
        $input = $request->validated();
        if ($request->hasFile("logo")) {
            $input["logo_path"] = $service->storeFile(Constants::MEETUPS_LOGOS_PATH, $request->file("logo"));
        }

        $meetup->update($input);

        if ($request->has("speakers")) {
            $meetup->speakers()->sync($input["speakers"]);
        } else {
            $meetup->speakers()->sync([]);
        }

        return redirect()->route("meetups");
    }

    public function destroy(Meetup $meetup): RedirectResponse
    {
        $meetup->delete();

        return back();
    }
}
