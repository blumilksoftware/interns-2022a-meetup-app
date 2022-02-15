<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\Paths;

$config = new Config(
    paths: new Paths(
        "app",
        "bootstrap/app.php",
        "config",
        "database",
        "lang",
        "routes",
        "tests",
        "ecs.php",
    ),
);

return $config->config();
