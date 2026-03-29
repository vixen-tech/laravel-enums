<?php

namespace Vixen\Enums;

trait Only
{
    /**
     * @param array<string> $cases
     */
    public static function only(array $cases): EnumCollection
    {
        $values = new EnumCollection();

        foreach ($cases as $case) {
            $values[] = constant(self::class . '::' . $case);
        }

        return $values;
    }
}
