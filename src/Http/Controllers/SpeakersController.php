<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Contracts\StoreFile;
use Blumilk\Meetup\Core\Http\Requests\PaginationRequest;
use Blumilk\Meetup\Core\Http\Requests\Speaker\UpdateSpeakerRequest;
use Blumilk\Meetup\Core\Models\Speaker;
use Blumilk\Meetup\Core\Models\Utils\Constants;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SpeakersController extends Controller
{
    public function index(PaginationRequest $request): View
    {
        $paginationLimit = $request->input("limit");
        $speakers = Speaker::query()->latest()->paginate($paginationLimit);

        return view("speakers.index")
            ->with("speakers", $speakers);
    }

    public function create(): View
    {
        return view("speakers.create");
    }

    public function edit(Speaker $speaker): View
    {
        return view("speakers.edit")
            ->with("speaker", $speaker);
    }

    public function store(UpdateSpeakerRequest $request, StoreFile $service): RedirectResponse
    {
        $input = $request->validated();
        if ($request->hasFile("avatar")) {
            $input["avatar_path"] = $service->storeFile(Constants::SPEAKERS_AVATARS_PATH, $request->file("avatar"));
        }

        Speaker::query()->create($input);

        return redirect()->route("admin.speakers");
    }

    public function show(Speaker $speaker): View
    {
        return view("speakers.show")
            ->with("speaker", $speaker);
    }

    public function update(UpdateSpeakerRequest $request, StoreFile $service, Speaker $speaker): RedirectResponse
    {
        $input = $request->validated();
        if ($request->hasFile("avatar")) {
            $input["avatar_path"] = $service->storeFile(Constants::SPEAKERS_AVATARS_PATH, $request->file("avatar"));
        }

        $speaker->update($input);

        return redirect()->route("admin.speakers");
    }

    public function destroy(Speaker $speaker): RedirectResponse
    {
        $speaker->delete();

        return back();
    }
}
