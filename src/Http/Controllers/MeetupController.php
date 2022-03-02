<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\StoreMeetupRequest;
use Blumilk\Meetup\Core\Http\Requests\UpdateMeetupRequest;
use Blumilk\Meetup\Core\Models\Meetup;

class MeetupController extends Controller
{
    public function index()
    {
        $meetups = Meetup::latest()->with(["user"])->paginate(20);

        return view("meetups.index")
            ->with("meetups", $meetups);
    }

    public function create()
    {
        return view("meetups.create");
    }

    public function store(StoreMeetupRequest $request)
    {
        $request->user()->meetups()->create($request->validated());

        return redirect()->route("meetups");
    }

    public function edit(Meetup $meetup)
    {
        return view("meetups.edit")
            ->with("meetup", $meetup);
    }

    public function update(UpdateMeetupRequest $request, Meetup $meetup)
    {
        $meetup->update($request->validated());

        return redirect()->route("meetups");
    }

    public function destroy(Meetup $meetup)
    {
        $meetup->delete();

        return back();
    }
}
