<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\StoreOrganizationRequest;
use Blumilk\Meetup\Core\Http\Requests\UpdateOrganizationRequest;
use Blumilk\Meetup\Core\Models\Organization;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrganizationController extends Controller
{
    public function index(): View
    {
        $organizations = Organization::orderBy("name")->paginate(20);

        return view("organizations.index")
            ->with("organizations", $organizations);
    }

    public function create(): View
    {
        return view("organizations.create");
    }

    public function store(StoreOrganizationRequest $request): RedirectResponse
    {
        Organization::create($request->validated());

        return redirect()->route("organizations");
    }

    public function edit(Organization $organization): View
    {
        return view("organizations.edit")
            ->with("organization", $organization);
    }

    public function update(UpdateOrganizationRequest $request, Organization $organization): RedirectResponse
    {
        $organization->update($request->validated());

        return redirect()->route("organizations");
    }

    public function destroy(Organization $organization): RedirectResponse
    {
        $organization->delete();

        return back();
    }
}
