<?php

namespace Vixen\Enums\Tests\Samples;

use Vixen\Enums\Attributes\Label;
use Vixen\Enums\Filterable;
use Vixen\Enums\HasDescriptions;
use Vixen\Enums\HasLabels;
use Vixen\Enums\HasOptions;

enum HasOptionsEnum: string
{
    use Filterable;
    use HasDescriptions;
    use HasLabels;
    use HasOptions;

    case Square = 'square';
    #[Label('Rectangle')]
    case Rect = 'rect';
}
