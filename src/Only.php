<?php

namespace Vixen\Enums;

use Illuminate\Support\Collection;

trait Only
{
    /**
     * @param array<string> $cases
     */
    public static function only(array $cases): Collection
    {
        $values = collect();

        foreach ($cases as $case) {
            $values->push(constant(self::class . '::' . $case));
        }

        return $values;
    }
}
