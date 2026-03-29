<?php

namespace Vixen\Enums;

use Illuminate\Support\Collection;

class EnumCollection extends Collection
{
    public function toArray(): array
    {
        return $this->map(fn (string | \BackedEnum $value) => is_string($value) ? $value : $value->value)->all();
    }

    public function toOptions(): array
    {
        return $this->mapWithKeys(fn (\BackedEnum $value) => [$value->value => $value->label()])->all();
    }
}
