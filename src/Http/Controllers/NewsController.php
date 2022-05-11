<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\News\NewsRequest;
use Blumilk\Meetup\Core\Models\News;
use Blumilk\Meetup\Core\Models\Utils\Constants;
use Blumilk\Meetup\Core\Services\StoreFileService;
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

    public function store(NewsRequest $request, StoreFileService $service): RedirectResponse
    {
        $input = $request->validated();
        if ($request->hasFile("logo")) {
            $input["logo_path"] = $service->storeFile(Constants::NEWS_LOGOS_PATH, $request->file("logo"));
        }

        $request->user()->news()->create($input);

        return redirect()->route("admin.news");
    }

    public function show(News $news): View
    {
        return view("news.show")
            ->with("news", $news);
    }

    public function edit(News $news): View
    {
        return view("news.edit")
            ->with("news", $news);
    }

    public function update(NewsRequest $request, News $news, StoreFileService $service): RedirectResponse
    {
        $input = $request->validated();
        if ($request->hasFile("logo")) {
            $input["logo_path"] = $service->storeFile(Constants::NEWS_LOGOS_PATH, $request->file("logo"));
        }

        $news->update($input);

        return redirect()->route("admin.news");
    }

    public function destroy(News $news): RedirectResponse
    {
        $news->delete();

        return back();
    }
}
