<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\News\NewsRequest;
use Blumilk\Meetup\Core\Models\News;
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

    public function store(NewsRequest $request): RedirectResponse
    {
        $input = $request->validated();

        $request->user()->news()->create($input);

        return redirect()->route("news");
    }

    public function edit(News $news): View
    {
        return view("news.edit")
            ->with("news", $news);
    }

    public function update(NewsRequest $request, News $news): RedirectResponse
    {
        $news->update($request->validated());

        return redirect()->route("news");
    }

    public function destroy(News $news): RedirectResponse
    {
        $news->delete();

        return back();
    }
}
