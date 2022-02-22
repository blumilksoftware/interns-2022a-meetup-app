<?php

use Blumilk\Meetup\Core\MeetupApplication;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

require __DIR__ . '/../vendor/autoload.php';

$application = new MeetupApplication((string)__DIR__."/../");
$application->run();