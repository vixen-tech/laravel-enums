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
            if (!defined(self::class . '::' . $case)) {
                throw new \ValueError(sprintf(
                    '"%s" is not a valid case for enum %s.',
                    $case,
                    self::class,
                ));
            }

            $values->push(constant(self::class . '::' . $case));
        }

        return $values;
    }
}
