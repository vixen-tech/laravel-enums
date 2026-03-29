<?php

namespace Vixen\Enums;

use Illuminate\Support\Collection;

/**
 * @extends Collection<int, \BackedEnum>
 */
class EnumCollection extends Collection
{
    public function toOptions(): Collection
    {
        return $this->map(fn ($case) => [
            'label' => $case->label(),
            'value' => $case->value,
        ])->values();
    }

    public function toDescriptiveOptions(): Collection
    {
        return $this->map(fn ($case) => [
            'label' => $case->label(),
            'value' => $case->value,
            'description' => $case->description(),
        ])->values();
    }
}
