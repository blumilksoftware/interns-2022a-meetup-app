<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Speaker\Rules;

use Blumilk\Meetup\Core\Http\Requests\BaseRules;

class GithubLinkRules extends BaseRules
{
    protected static array $rules = [
        "regex:/http(s)?:\/\/(www\.)?github\.com\/.+/i",
        "nullable",
    ];
}
