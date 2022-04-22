<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Enums;

enum AvailableNewsletter: string
{
    case News = "news";
    case Meetups = "meetups";

    public static function values(): array
    {
        return array_column(self::cases(), "value");
    }
}
