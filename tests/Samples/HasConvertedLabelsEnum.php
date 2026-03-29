<?php

namespace Vixen\Enums\Tests\Samples;

use Vixen\Enums\Attributes\Label;
use Vixen\Enums\HasLabels;

enum HasConvertedLabelsEnum: int
{
    use HasLabels;

    #[Label('Square Shape')]
    case SquareShape = 1;

    case RectangularShape = 2;
}
