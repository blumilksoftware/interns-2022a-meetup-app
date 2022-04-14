<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\Newsletter\NewsletterStoreRequest;
use Blumilk\Meetup\Core\Http\Requests\Newsletter\NewsletterUpdateRequest;
use Blumilk\Meetup\Core\Models\NewsletterSubscriber;
use Blumilk\Meetup\Core\Services\NewsletterService;
use Illuminate\View\View;

class NewsletterSubscriberController extends Controller
{
    public function create(): View
    {
        return view("newsletter.index");
    }

    public function store(NewsletterStoreRequest $request, NewsletterService $service): View
    {
        $subscriber = NewsletterSubscriber::query()->firstOrCreate([
            "email" => $request->validated("email"),
        ]);
        $message = $service->isSubscriber($subscriber);

        return view("newsletter.subscribe")
            ->with("message", $message)
            ->with("subscriber", $subscriber);
    }

    public function edit(): View
    {
        return view("newsletter.subscribe");
    }

    public function update(NewsletterUpdateRequest $request, NewsletterService $service, NewsletterSubscriber $subscriber): View
    {
        $subscriber = $subscriber->newQuery()->where("email", $request->validated("email"))->first();
        $message = $service->preference($subscriber, $request->validated("type"));

        return view("newsletter.dashboard")->with("message", $message);
    }

    public function destroy(NewsletterStoreRequest $request, NewsletterService $service): View
    {
        $subscriber = NewsletterSubscriber::query()->firstOrCreate([
            "email" => $request->validated("email"),
        ]);
        $message = $service->unsubscribe($subscriber);

        return view("newsletter.dashboard")->with("message", $message);
    }
}
