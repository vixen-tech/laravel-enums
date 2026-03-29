<?php

namespace Vixen\Enums;

use Illuminate\Support\Collection;

trait HasOptions
{
    abstract public function label(): string;

    final public static function options(): Collection
    {
        $options = collect();

        foreach (self::cases() as $case) {
            $options->push([
                'label' => $case->label(),
                'value' => $case->value,
            ]);
        }

        return $options;
    }
}
