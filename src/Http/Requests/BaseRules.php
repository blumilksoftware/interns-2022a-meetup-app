<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests;

class BaseRules
{
    protected static array $rules;

    public static function rules(array $additionalRules = []): array
    {
        return array_merge(static::$rules, $additionalRules);
    }
}
