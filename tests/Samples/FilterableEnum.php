<?php

namespace Vixen\Enums\Tests\Samples;

use Vixen\Enums\Filterable;

enum FilterableEnum: string
{
    use Filterable;

    case NAME_1 = 'value_1';
    case NAME_2 = 'value_2';
    case NAME_3 = 'value_3';
    case NAME_4 = 'value_4';
}
