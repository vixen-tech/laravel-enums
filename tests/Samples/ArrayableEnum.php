<?php

namespace Vixen\Enums\Tests\Samples;

use Vixen\Enums\Attributes\Label;
use Vixen\Enums\HasLabels;
use Vixen\Enums\ToArray;

enum ArrayableEnum: int
{
    use HasLabels;
    use ToArray;

    #[Label('Member')]
    case Member = 0;

    #[Label('Admin')]
    case Admin = 5;
}
