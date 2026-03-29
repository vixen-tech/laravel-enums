<?php

namespace Vixen\Enums\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class LongLabel extends Label
{
    public function __construct(string $label)
    {
        parent::__construct($label, type: 'long');
    }
}
