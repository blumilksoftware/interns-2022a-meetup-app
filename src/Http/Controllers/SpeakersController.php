<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Contracts\StoreFile;
use Blumilk\Meetup\Core\Http\Requests\Speaker\UpdateSpeakerRequest;
use Blumilk\Meetup\Core\Models\Speaker;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SpeakersController extends Controller
{
    public function index(): View
    {
        $speakers = Speaker::query()->latest()->paginate(20);

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
            ->with("speakers", $speaker);
    }

    public function store(UpdateSpeakerRequest $request, StoreFile $service): RedirectResponse
    {
        $service->storeFile("speakers", $request->file("avatar"));
        Speaker::query()->create($request->validated());

        return redirect()->route("speakers");
    }

    public function update(UpdateSpeakerRequest $request, Speaker $speaker): RedirectResponse
    {
        $speaker->update($request->validated());

        return redirect()->route("speakers");
    }

    public function destroy(Speaker $speaker): RedirectResponse
    {
        $speaker->delete();

        return back();
    }
}
