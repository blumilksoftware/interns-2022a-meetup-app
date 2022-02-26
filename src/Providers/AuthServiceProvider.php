<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Providers;

use Blumilk\Meetup\Core\Models\Meetup;
use Blumilk\Meetup\Core\Policies\MeetupPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Meetup::class => MeetupPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
