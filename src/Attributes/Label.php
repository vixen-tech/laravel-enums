<?php

namespace Vixen\Enums\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class Label
{
    /** @param 'default'|'long'|'short' $type */
    public function __construct(
        protected readonly string $label,
        private readonly string $type = 'default',
    ) {}

    public function label(): string
    {
        return __($this->label);
    }

    /** @internal */
    public function type(): string
    {
        return $this->type;
    }
}
