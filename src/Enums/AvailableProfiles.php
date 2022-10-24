<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Enums;

enum AvailableProfiles: string
{
    case Facebook = "Facebook";
    case Linkedin = "Linkedin";
    case Instagram = "Instagram";
    case YouTube = "YouTube";
    case Twitter = "Twitter";
    case GitHub = "GitHub";
}
