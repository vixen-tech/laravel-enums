<?php

namespace Vixen\Enums\Tests\Samples;

use Vixen\Enums\ToValue;

enum ToValueEnum: string
{
    use ToValue;

    case Active = 'active';
    case Inactive = 'inactive';
}
