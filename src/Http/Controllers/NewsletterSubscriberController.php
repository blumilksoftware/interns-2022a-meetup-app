<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Controllers;

use Blumilk\Meetup\Core\Http\Requests\NewsletterStoreRequest;
use Blumilk\Meetup\Core\Models\NewsletterSubscriber;
use Blumilk\Meetup\Core\Services\NewsletterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewsletterSubscriberController extends Controller
{
    public function create(): View
    {
        return view("newsletter");
    }

    public function store(NewsletterStoreRequest $request): RedirectResponse
    {
        $subscriber = NewsletterSubscriber::query()->firstOrCreate($request->validated());
        $service = new NewsletterService();
        $message = $service->checkIfSubriber($subscriber);

        return back()->with("message", $message->content());
    }
}
