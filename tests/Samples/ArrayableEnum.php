<?php

namespace Vixen\Enums\Tests\Samples;

use Vixen\Enums\Attributes\Label;
use Vixen\Enums\HasLabels;
use Vixen\Enums\HasValues;
use Vixen\Enums\ToArray;
use Vixen\Enums\ToValue;

enum ArrayableEnum: int
{
    use HasLabels;
    use HasValues;
    use ToArray;
    use ToValue;

    #[Label('Member')]
    case Member = 0;

    #[Label('Admin')]
    case Admin = 5;
}
