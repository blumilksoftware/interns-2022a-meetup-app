<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\StoreOrganizationRequest;
use Blumilk\Meetup\Core\Http\Requests\UpdateOrganizationRequest;
use Blumilk\Meetup\Core\Models\Organization;
use Blumilk\Meetup\Core\Services\Organization\StoreFileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $organizations = Organization::query()->orderBy("name")->paginate(20);

        return view("organizations.index")
            ->with("organizations", $organizations);
    }

    public function create(): View
    {
        return view("organizations.create");
    }

    public function store(StoreOrganizationRequest $request, StoreFileService $service): RedirectResponse
    {
        $input = $request->validated();
        $input["logo"] = $service->storeFile("organizations/logos", $request->file("logo"));

        Organization::query()->create($input);

        return redirect()->route("organizations");
    }

    public function edit(Organization $organization): View
    {
        return view("organizations.edit")
            ->with("organization", $organization);
    }

    public function update(UpdateOrganizationRequest $request, Organization $organization, StoreFileService $storeFileService): RedirectResponse
    {
        $input = $request->validated();
        if ($request->hasFile("logo")) {
            $input["logo"] = $storeFileService->storeFile("organizations/logos", $request->file("logo"));
        }

        $organization->update($input);

        return redirect()->route("organizations");
    }

    public function destroy(Organization $organization): RedirectResponse
    {
        $organization->delete();

        return back();
    }
}
