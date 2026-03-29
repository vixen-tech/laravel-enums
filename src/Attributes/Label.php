<?php

namespace Vixen\Enums\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class Label
{
    public function __construct(private readonly string $label) {}

    public function label(): string
    {
        return __($this->label);
    }
}
