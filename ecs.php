<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\Paths;

$config = new Config(
    paths: new Paths(
        "config",
        "database",
        "lang",
        "src",
        "tests",
        "ecs.php",
    ),
);

return $config->config();
