<?php

namespace Vixen\Enums\Tests\Samples;

use Vixen\Enums\Attributes\Label;
use Vixen\Enums\Attributes\LongLabel;
use Vixen\Enums\Attributes\ShortLabel;
use Vixen\Enums\HasLabels;

enum HasLongLabelsEnum: int
{
    use HasLabels;

    #[Label('Diamond Shape')]
    case Diamond = 1;

    #[Label('Heart Shape')]
    #[LongLabel('This is a heart shape')]
    case Heart = 2;

    #[ShortLabel('This is a pyramid')]
    case Pyramid = 3;
}
