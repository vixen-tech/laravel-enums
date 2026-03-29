<?php

namespace Vixen\Enums\Tests\Samples;

use Vixen\Enums\ToValue;

enum ToValueIntEnum: int
{
    use ToValue;

    case Member = 0;
    case Admin = 5;
}
