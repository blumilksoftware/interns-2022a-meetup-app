<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core;

class FilesFilter
{
    protected const FILES = [
        ".gitignore",
    ];

    public static function filter(string $fileName): bool
    {
        return in_array($fileName, self::FILES, true);
    }
}
