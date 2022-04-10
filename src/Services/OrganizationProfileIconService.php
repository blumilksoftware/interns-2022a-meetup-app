<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\Utils\Constants;
use Illuminate\Support\Str;

class OrganizationProfileIconService
{
    protected string $path;

    public function getPath(string $label): string
    {
        $this->path = Constants::PROFILE_ICON_PATH . $label . ".svg";

        return Str::lower($this->path);
    }
}
