<?php

namespace Vixen\Enums\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class ShortLabel extends Label
{
    public function __construct(string $label)
    {
        parent::__construct($label, type: 'short');
    }

    /**
     * This method should not use translations since it's meant for abbreviations.
     */
    public function label(): string
    {
        return $this->label;
    }
}
