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
    public function __construct(
        protected NewsletterService $service,
    ) {}

    public function create(): View
    {
        return view("newsletter.index");
    }

    public function store(NewsletterStoreRequest $request): View
    {
        $subscriber = NewsletterSubscriber::query()->firstOrCreate([
            "email" => $request->validated("email"),
        ]);

        return view("newsletter.subscribe")
            ->with("subscriber", $subscriber);
    }

    public function edit(): View
    {
        return view("newsletter.subscribe");
    }

    public function update(NewsletterUpdateRequest $request): View
    {
        $subscriber = NewsletterSubscriber::query()->firstOrCreate([
            "email" => $request->validated("email"),
        ]);
        $this->service->subscribe($subscriber);
        $this->service->preference($subscriber, $request->validated("type"));

        return view("newsletter.dashboard")->with("message", "You are now subscribed.");
    }

    public function delete(NewsletterStoreRequest $request): View
    {
        return view("newsletter.unsubscribe")->with("email", $request->validated("email"));
    }

    public function destroy(NewsletterStoreRequest $request): View
    {
        $subscriber = NewsletterSubscriber::query()->firstOrCreate([
            "email" => $request->validated("email"),
        ]);
        $this->service->unsubscribe($subscriber);

        return view("newsletter.dashboard")->with("message", "Your subscription is cancelled");
    }
}
