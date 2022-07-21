<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Enums;

use Illuminate\Support\Collection;

enum AvailableGenders: string
{
    case Female = "Female";
    case Male = "Male";

    public function label(): string
    {
        return __($this->value);
    }

    public static function casesToSelect(): array
    {
        $cases = AvailableGenders::all();

        return $cases->map(
            fn(AvailableGenders $enum): array => [
                "label" => $enum->label(),
                "value" => $enum->value,
            ],
        )->toArray();
    }

    public static function all(): Collection
    {
        return new Collection(AvailableGenders::cases());
    }
}
