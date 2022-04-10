<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Enums\AvailableProfiles;
use Blumilk\Meetup\Core\Http\Requests\Organization\Profile\StoreOrganizationProfileRequest;
use Blumilk\Meetup\Core\Http\Requests\Organization\Profile\UpdateOrganizationProfileRequest;
use Blumilk\Meetup\Core\Models\Organization;
use Blumilk\Meetup\Core\Models\OrganizationProfile;
use Blumilk\Meetup\Core\Services\OrganizationProfileIconService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrganizationProfileController extends Controller
{
    public function __construct(
        protected OrganizationProfileIconService $service,
    ) {}

    public function create(Organization $organization): View
    {
        return view("organizations.profiles.create")
            ->with([
                "organization" => $organization,
                "availableProfiles" => AvailableProfiles::casesToSelect(),
            ]);
    }

    public function store(StoreOrganizationProfileRequest $request, Organization $organization): RedirectResponse
    {
        $organization->organizationProfiles()->create($request->validated() + [
            "icon" => $this->service->getPath($request["label"]),
        ]);

        return redirect()->route("organizations.edit", $organization);
    }

    public function edit(Organization $organization, OrganizationProfile $profile): View
    {
        return view("organizations.profiles.edit")
            ->with([
                "organization" => $organization,
                "profile" => $profile,
                "availableProfiles" => AvailableProfiles::casesToSelect(),
            ]);
    }

    public function update(UpdateOrganizationProfileRequest $request, Organization $organization, OrganizationProfile $profile): RedirectResponse
    {
        $profile->update($request->validated() + [
            "icon" => $this->service->getPath($request["label"]),
        ]);

        return redirect()->route("organizations.edit", $organization);
    }

    public function destroy(Organization $organization, OrganizationProfile $profile): RedirectResponse
    {
        $profile->delete();

        return back();
    }
}
