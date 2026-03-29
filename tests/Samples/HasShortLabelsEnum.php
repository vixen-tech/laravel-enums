<?php

namespace Vixen\Enums\Tests\Samples;

use Vixen\Enums\Attributes\LongLabel;
use Vixen\Enums\Attributes\ShortLabel;
use Vixen\Enums\HasLabels;

enum HasShortLabelsEnum: int
{
    use HasLabels;

    case Diamond = 1;

    #[ShortLabel('HRT')]
    case Heart = 2;

    #[LongLabel('This is a pyramid')]
    #[ShortLabel('PRM')]
    case Pyramid = 3;
}
