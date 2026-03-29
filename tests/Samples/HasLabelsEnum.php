<?php

namespace Vixen\Enums\Tests\Samples;

use Vixen\Enums\Attributes\Label;
use Vixen\Enums\HasLabels;

enum HasLabelsEnum: int
{
    use HasLabels;

    #[Label('Diamond Shape')]
    case Diamond = 1;

    #[Label('Heart Shape')]
    case Heart = 2;

    #[Label('Pyramid Shape')]
    case Pyramid = 3;
}
