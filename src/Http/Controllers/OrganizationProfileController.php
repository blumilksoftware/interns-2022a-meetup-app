<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Enums\AvailableProfiles;
use Blumilk\Meetup\Core\Http\Requests\Organization\Profile\StoreOrganizationProfileRequest;
use Blumilk\Meetup\Core\Http\Requests\Organization\Profile\UpdateOrganizationProfileRequest;
use Blumilk\Meetup\Core\Models\Organization;
use Blumilk\Meetup\Core\Models\OrganizationProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\LaravelOptions\Options;

class OrganizationProfileController extends Controller
{
    public function create(Organization $organization): View
    {
        return view("organizations.profiles.create")
            ->with([
                "organization" => $organization,
                "availableProfiles" => Options::forEnum(AvailableProfiles::class)->toArray(),
            ]);
    }

    public function store(StoreOrganizationProfileRequest $request, Organization $organization): RedirectResponse
    {
        $organization->organizationProfiles()->create($request->validated());

        return redirect()->route("organizations.edit", $organization);
    }

    public function edit(Organization $organization, OrganizationProfile $profile): View
    {
        return view("organizations.profiles.edit")
            ->with([
                "organization" => $organization,
                "profile" => $profile,
                "availableProfiles" => Options::forEnum(AvailableProfiles::class)->toArray(),
            ]);
    }

    public function update(UpdateOrganizationProfileRequest $request, Organization $organization, OrganizationProfile $profile): RedirectResponse
    {
        $profile->update($request->validated());

        return redirect()->route("organizations.edit", $organization);
    }

    public function destroy(Organization $organization, OrganizationProfile $profile): RedirectResponse
    {
        $profile->delete();

        return back();
    }
}
