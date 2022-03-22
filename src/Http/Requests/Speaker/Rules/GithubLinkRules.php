<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Speaker\Rules;

use Blumilk\Meetup\Core\Http\Requests\BaseRules;

class GithubLinkRules extends BaseRules
{
    protected static array $rules = [
        "starts_with:https://github.com/",
        "nullable",
    ];
}
