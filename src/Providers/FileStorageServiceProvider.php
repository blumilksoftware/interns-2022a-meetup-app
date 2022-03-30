<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Providers;

use Blumilk\Meetup\Core\Contracts\StoreFile;
use Blumilk\Meetup\Core\Services\StoreFileService;
use Illuminate\Support\ServiceProvider;

class FileStorageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StoreFile::class, StoreFileService::class);
    }
}
