<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Enums;

enum Role: string
{
    case User = "user";
    case Administrator = "administrator";

    public function label(): string
    {
        return __($this->value);
    }

    public static function casesToSelect(): array
    {
        $cases = collect(Role::cases());

        return $cases->map(
            fn(Role $enum): array => [
                "label" => $enum->label(),
                "value" => $enum->value,
            ],
        )->toArray();
    }
}
