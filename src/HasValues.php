<?php

namespace Vixen\Enums;

trait HasValues
{
    /**
     * @return array<int|string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
