<?php

namespace Vixen\Enums;

use Illuminate\Support\Collection;

trait HasValues
{
    public static function values(): Collection
    {
        return collect(array_column(self::cases(), 'value'));
    }
}
