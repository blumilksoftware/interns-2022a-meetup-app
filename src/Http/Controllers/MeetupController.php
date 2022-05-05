<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\Meetup\StoreMeetupRequest;
use Blumilk\Meetup\Core\Http\Requests\Meetup\UpdateMeetupRequest;
use Blumilk\Meetup\Core\Http\Requests\PaginationRequest;
use Blumilk\Meetup\Core\Models\Meetup;
use Blumilk\Meetup\Core\Models\Organization;
use Blumilk\Meetup\Core\Models\Speaker;
use Blumilk\Meetup\Core\Models\Utils\Constants;
use Blumilk\Meetup\Core\Services\StoreFileService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MeetupController extends Controller
{
    public function __construct(
        protected StoreFileService $storeFileService,
    ) {}

    public function index(PaginationRequest $request): View
    {
        $paginationLimit = $request->input("limit");
        $meetups = Meetup::query()->latest()->with(["user"])->paginate($paginationLimit);

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

    public function store(StoreMeetupRequest $request): RedirectResponse
    {
        $input = $request->validated();
        if ($request->hasFile("logo")) {
            $input["logo_path"] = $this->storeFileService->storeFile(Constants::MEETUPS_LOGOS_PATH, $request->file("logo"));
        }

        $meetup = $request->user()->meetups()->create($input);

        $meetup->speakers()->sync($input["speakers"]);

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

    public function update(UpdateMeetupRequest $request, Meetup $meetup): RedirectResponse
    {
        $input = $request->validated();
        if ($request->hasFile("logo")) {
            $input["logo_path"] = $this->storeFileService->storeFile(Constants::MEETUPS_LOGOS_PATH, $request->file("logo"));
        }

        $meetup->update($input);

        $meetup->speakers()->sync($input["speakers"]);

        return redirect()->route("meetups");
    }

    public function destroy(Meetup $meetup): RedirectResponse
    {
        $meetup->delete();

        return back();
    }
}
