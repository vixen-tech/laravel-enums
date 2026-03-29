<?php

namespace Vixen\Enums\Tests\Samples;

use Vixen\Enums\HasValues;

enum HasValuesIntEnum: int
{
    use HasValues;

    case Member = 0;
    case Admin = 5;
}
