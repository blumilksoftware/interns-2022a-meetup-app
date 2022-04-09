<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services\Authentication;

enum AvailableAuthentication: string
{
    case GOOGLE = "google";
    case FACEBOOK = "facebook";
}
