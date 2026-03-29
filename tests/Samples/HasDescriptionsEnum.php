<?php

namespace Vixen\Enums\Tests\Samples;

use Vixen\Enums\Attributes\Description;
use Vixen\Enums\Attributes\Label;
use Vixen\Enums\Filterable;
use Vixen\Enums\HasDescriptions;
use Vixen\Enums\HasLabels;
use Vixen\Enums\HasOptions;

enum HasDescriptionsEnum: string
{
    use Filterable;
    use HasDescriptions;
    use HasLabels;
    use HasOptions;

    #[Label('Diamond')]
    #[Description('A precious stone of crystallized carbon')]
    case Diamond = 'diamond';

    #[Label('Heart')]
    #[Description('A vital organ that pumps blood')]
    case Heart = 'heart';

    #[Label('Pyramid')]
    case Pyramid = 'pyramid';
}
