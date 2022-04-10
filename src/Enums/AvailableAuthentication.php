<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Enums;

enum AvailableAuthentication: string
{
    case GOOGLE = "google";
    case FACEBOOK = "facebook";
}
