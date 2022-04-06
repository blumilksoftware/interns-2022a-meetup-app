<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core;

use Blumilk\Meetup\Core\Console\Kernel as ConsoleKernel;
use Blumilk\Meetup\Core\Exceptions\Handler as ExceptionsHandler;
use Blumilk\Meetup\Core\Http\Kernel as HttpKernel;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionsHandlerContract;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Bootstrap\LoadConfiguration;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\ArgvInput as Input;
use Symfony\Component\Console\Output\ConsoleOutput as Output;

final class MeetupApplication
{
    private Application $app;

    public function __construct(string $basePath, string $envFilename = ".env")
    {
        $this->bootstrapApplication($basePath, $envFilename);
    }

    public function run(): void
    {
        /** @var HttpKernelContract $kernel */
        $kernel = $this->app->make(HttpKernelContract::class);
        $request = Request::capture();

        $response = $kernel->handle($request);
        $response->send();

        $kernel->terminate($request, $response);
    }

    public function runConsole(): int
    {
        /** @var ConsoleKernelContract $kernel */
        $kernel = $this->app->make(ConsoleKernelContract::class);

        $input = new Input();
        $status = $kernel->handle($input, new Output());
        $kernel->terminate($input, $status);

        return $status;
    }

    /**
     * @internal
     */
    public function getApplication(): Application
    {
        return $this->app;
    }

    private function bootstrapApplication(string $instancePath, string $envFilename = ".env"): void
    {
        $instancePath = realpath($instancePath);
        $_ENV["INSTANCE_PATH"] = $instancePath;

        $this->defineApplicationStart();
        $this->registerApplicationCaches($instancePath);
        $base = $_ENV["APP_BASE_PATH"] ?? dirname(__DIR__);

        $this->app = new Application($base);
        $this->app->useAppPath($base . "/src");
        $this->app->useEnvironmentPath($instancePath);
        $this->app->useStoragePath($instancePath . "/storage");
        $this->loadEnvironment($envFilename);

        $this->app->singleton(HttpKernelContract::class, HttpKernel::class);
        $this->app->singleton(ConsoleKernelContract::class, ConsoleKernel::class);
        $this->app->singleton(ExceptionsHandlerContract::class, ExceptionsHandler::class);
    }

    private function defineApplicationStart(): void
    {
        if (!defined("LARAVEL_START")) {
            define("LARAVEL_START", microtime(true));
        }
    }

    private function registerApplicationCaches(string $basePath): void
    {
        $_ENV["APP_SERVICES_CACHE"] = $basePath . "/storage/app/services.php";
        $_ENV["APP_PACKAGES_CACHE"] = $basePath . "/storage/app/packages.php";
    }

    private function loadEnvironment(string $envFilename): void
    {
        $this->app->loadEnvironmentFrom($envFilename);

        $environmentVariables = new LoadEnvironmentVariables();
        $environmentVariables->bootstrap($this->app);

        $configuration = new LoadConfiguration();
        $configuration->bootstrap($this->app);
    }
}
