<?php

namespace Vixen\Enums;

trait Filterable
{
    /**
     * @param array<string> $cases
     */
    public static function only(array $cases): EnumCollection
    {
        return new EnumCollection(
            collect(self::cases())
                ->filter(fn ($case) => in_array($case->name, $cases))
                ->values()
        );
    }

    /**
     * @param array<string> $cases
     */
    public static function except(array $cases): EnumCollection
    {
        return new EnumCollection(
            collect(self::cases())
                ->filter(fn ($case) => !in_array($case->name, $cases))
                ->values()
        );
    }
}
