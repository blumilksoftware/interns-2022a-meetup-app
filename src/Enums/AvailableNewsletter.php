<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Enums;

enum AvailableNewsletter: string
{
    case NEWS = "news";
    case MEETUPS = "meetups";

    public static function values(): array
    {
        $cases = collect(AvailableNewsletter::cases());

        return $cases->map(
            fn(AvailableNewsletter $enum) => $enum->value,
        )->toArray();
    }
}
