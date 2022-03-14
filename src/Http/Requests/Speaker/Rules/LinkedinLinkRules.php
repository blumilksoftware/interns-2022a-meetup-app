<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Speaker\Rules;

use Blumilk\Meetup\Core\Http\Requests\BaseRules;

class LinkedinLinkRules extends BaseRules
{
    protected static array $rules = [
        "regex:/http(s)?:\/\/(www\.)?linkedin\.com\/.+/i",
        "nullable",
    ];
}
