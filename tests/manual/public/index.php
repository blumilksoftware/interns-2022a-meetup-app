<?php

declare(strict_types=1);

use Blumilk\Meetup\Core\MeetupApplication;

require __DIR__ . "../../vendor/autoload.php";

$application = new MeetupApplication((string)__DIR__ . "/../");
$application->run();
