<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Models\Meetup;
use Illuminate\Http\Request;

class MeetupController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth"])->except("index");
    }

    public function index()
    {
        $meetups = Meetup::latest()->with(["user"])->paginate(20);

        return view("meetups.index", [
            "meetups" => $meetups,
        ]);
    }

    public function create()
    {
        return view("meetups.create");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "title" => "required",
            "date" => "required",
            "place" => "required",
            "language" => "required",
        ]);

        $request->user()->meetups()->create($request->all());

        return redirect()->route("meetups");
    }

    public function edit(Meetup $meetup)
    {
        $this->authorize("change", $meetup);

        return view("meetups.edit", [
            "meetup" => $meetup,
        ]);
    }

    public function update(Request $request, Meetup $meetup)
    {
        $this->authorize("change", $meetup);

        $this->validate($request, [
            "title" => "required",
            "date" => "required",
            "place" => "required",
            "language" => "required",
        ]);

        $meetup->update($request->all());

        return redirect()->route("meetups");
    }

    public function destroy(Meetup $meetup)
    {
        $this->authorize("change", $meetup);

        $meetup->delete();

        return back();
    }
}
