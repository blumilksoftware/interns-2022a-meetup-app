<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Enums;

enum AvailableNewsletter: string
{
    case NEWS = "news";
    case MEETUPS = "meetups";

    public static function values(): array
    {
        return array_map(fn(AvailableNewsletter $enum): string => $enum->value, self::cases());
    }
}
