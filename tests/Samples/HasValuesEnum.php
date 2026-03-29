<?php

namespace Vixen\Enums\Tests\Samples;

use Vixen\Enums\HasValues;

enum HasValuesEnum: string
{
    use HasValues;

    case NAME_1 = 'value_1';
    case NAME_2 = 'value_2';
    case NAME_3 = 'value_3';
}
