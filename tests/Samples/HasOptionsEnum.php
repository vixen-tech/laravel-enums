<?php

namespace Vixen\Enums\Tests\Samples;

use Vixen\Enums\Attributes\Label;
use Vixen\Enums\HasLabels;
use Vixen\Enums\HasOptions;

enum HasOptionsEnum: string
{
    use HasLabels;
    use HasOptions;

    case Square = 'square';
    #[Label('Rectangle')]
    case Rect = 'rect';
}
