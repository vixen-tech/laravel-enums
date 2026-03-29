<?php

namespace Vixen\Enums;

use Vixen\Enums\Attributes\Description;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait HasDescriptions
{
    final public static function descriptions(): Collection
    {
        static $cache = null;

        return $cache ??= collect(self::buildDescriptions());
    }

    final public function description(): ?string
    {
        return static::descriptions()[$this->value];
    }

    private static function buildDescriptions(): array
    {
        $reflection = new \ReflectionEnum(self::class);

        if (!$reflection->isBacked()) {
            throw new \LogicException(sprintf(
                'The HasDescriptions trait requires a backed enum, but %s is not backed.',
                self::class,
            ));
        }

        $descriptions = [];

        foreach (self::cases() as $case) {
            $reflect = new \ReflectionEnumUnitCase(self::class, $case->name);
            $attrs = $reflect->getAttributes(Description::class);

            $attr = Arr::first($attrs);
            $descriptions[$case->value] = $attr?->newInstance()->description();
        }

        return $descriptions;
    }
}
