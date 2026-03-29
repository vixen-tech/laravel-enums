<?php

namespace Vixen\Enums\Attributes;

use Attribute;
use Illuminate\Support\Facades\File;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class Label
{
    public function __construct(private readonly string $label) {}

    public function label(): string
    {
        return File::exists(lang_path(sprintf('%s/%s.php', app()->currentLocale(), strtolower($this->label))))
            ? $this->label
            : __($this->label);
    }
}
