<?php

namespace Vixen\Enums\Tests\Samples;

use Vixen\Enums\Attributes\Label;
use Vixen\Enums\HasLabels;

enum SingleCaseEnum: string
{
    use HasLabels;

    #[Label('Only Option')]
    case Only = 'only';
}
