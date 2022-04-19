<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\StoreNewsRequest;
use Blumilk\Meetup\Core\Models\News;
use Blumilk\Meetup\Core\Models\Organization;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::query()->orderBy("date")->paginate(20);

        return view("news.index")
            ->with("news", $news);
    }

    public function create(): View
    {
        return view("news.create");
    }

    public function store(StoreNewsRequest $request): RedirectResponse
    {
        dd($request);
        return redirect()->route("news");
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
