<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\Organization\StoreOrganizationRequest;
use Blumilk\Meetup\Core\Http\Requests\Organization\UpdateOrganizationRequest;
use Blumilk\Meetup\Core\Models\Organization;
use Blumilk\Meetup\Core\Models\Utils\Constants;
use Blumilk\Meetup\Core\Services\StoreFileService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrganizationController extends Controller
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
        $input["logo_path"] = $service->storeFile(Constants::ORGANIZATIONS_LOGOS_PATH, $request->file("logo"));

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
            $input["logo_path"] = $storeFileService->storeFile(Constants::ORGANIZATIONS_LOGOS_PATH, $request->file("logo"));
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
