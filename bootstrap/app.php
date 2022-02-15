<?php

declare(strict_types=1);

use Blumilk\Meetup\Core\Console\Kernel as ConsoleKernel;
use Blumilk\Meetup\Core\Exceptions\Handler;
use Blumilk\Meetup\Core\Http\Kernel as HttpKernel;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Contracts\Debug\ExceptionHandler as HandlerContract;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;
use Illuminate\Foundation\Application;

$basePath = $_ENV["APP_BASE_PATH"] ?? dirname(__DIR__);
$application = new Application($basePath);

$application->singleton(HttpKernelContract::class, HttpKernel::class);
$application->singleton(ConsoleKernelContract::class, ConsoleKernel::class);
$application->singleton(HandlerContract::class, Handler::class);

return $application;
