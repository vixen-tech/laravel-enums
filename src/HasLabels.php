<?php

namespace Vixen\Enums;

use Vixen\Enums\Attributes\Label;
use Vixen\Enums\Attributes\LongLabel;
use Vixen\Enums\Attributes\ShortLabel;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait HasLabels
{
    final public static function labels(): array
    {
        return self::cachedLabels(Label::class);
    }

    final public static function longLabels(): array
    {
        return self::cachedLabels(LongLabel::class);
    }

    final public static function shortLabels(): array
    {
        return self::cachedLabels(ShortLabel::class);
    }

    final public function label(): string
    {
        return static::labels()[$this->value];
    }

    final public function getLabel(): string
    {
        return $this->label();
    }

    final public function longLabel(): string
    {
        return static::longLabels()[$this->value];
    }

    final public function shortLabel(): string
    {
        return static::shortLabels()[$this->value];
    }

    /**
     * Build labels from the enum cases based on the given attribute type.
     *
     * @param  class-string  $type
     */
    private static function buildLabels(string $type): array
    {
        $reflection = new \ReflectionEnum(self::class);

        if (!$reflection->isBacked()) {
            throw new \LogicException(sprintf(
                'The HasLabels trait requires a backed enum, but %s is not backed.',
                self::class,
            ));
        }

        $labels = [];

        foreach (self::cases() as $case) {
            $reflect = new \ReflectionEnumUnitCase(self::class, $case->name);
            $attrs = $reflect->getAttributes();

            $attr = self::extractCorrectAttribute($attrs, $type);
            $labels[$case->value] = $attr?->newInstance()->label()
                ?: __(Str::of($case->name)->snake()->replace('_', ' ')->apa()->value());
        }

        return $labels;
    }

    /**
     * @param  \ReflectionAttribute[]  $attrs
     * @param  class-string  $type
     */
    private static function extractCorrectAttribute(array $attrs, string $type): ?\ReflectionAttribute
    {
        $targetType = match ($type) {
            LongLabel::class => 'long',
            ShortLabel::class => 'short',
            default => 'default',
        };

        if ($type !== Label::class) {
            $attr = Arr::first($attrs, fn ($attr) => $attr->getName() === $type);

            if ($attr) {
                return $attr;
            }
        }

        $labelAttr = Arr::first($attrs, fn ($attr) => $attr->getName() === Label::class);

        if (!$labelAttr) {
            return null;
        }

        $labelType = $labelAttr->newInstance()->type();

        if ($labelType === $targetType || $labelType === 'default') {
            return $labelAttr;
        }

        return null;
    }

    /**
     * @param  class-string  $type
     */
    private static function cachedLabels(string $type): array
    {
        static $cache = [];

        return $cache[$type] ??= self::buildLabels($type);
    }
}
