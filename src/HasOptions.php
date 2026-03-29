<?php

namespace Vixen\Enums;

use Illuminate\Support\Collection;

trait HasOptions
{
    abstract public function label(): string;

    abstract public function description(): ?string;

    final public static function options(?array $only = null): Collection
    {
        return (new EnumCollection(self::cases()))->toOptions(only: $only);
    }

    final public static function descriptiveOptions(?array $only = null): Collection
    {
        return (new EnumCollection(self::cases()))->toDescriptiveOptions(only: $only);
    }
}
