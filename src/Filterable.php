<?php

namespace Vixen\Enums;

use Illuminate\Support\Collection;

trait Filterable
{
    /**
     * @param array<string> $cases
     */
    public static function only(array $cases): Collection
    {
        return collect(self::cases())
            ->filter(fn ($case) => in_array($case->name, $cases));
    }

    /**
     * @param array<string> $cases
     */
    public static function except(array $cases): Collection
    {
        return collect(self::cases())
            ->filter(fn ($case) => !in_array($case->name, $cases));
    }
}
