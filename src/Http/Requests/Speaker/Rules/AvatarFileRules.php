<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Speaker\Rules;

use Blumilk\Meetup\Core\Http\Requests\BaseRules;

class AvatarFileRules extends BaseRules
{
    protected static array $rules = [
        "required",
        "mimes:jpg,png,jpeg,gif",
        "max:2048",
    ];
}
