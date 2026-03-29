<?php

namespace Vixen\Enums\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class Description
{
    public function __construct(
        protected readonly string $description,
    ) {}

    public function description(): string
    {
        return __($this->description);
    }
}
