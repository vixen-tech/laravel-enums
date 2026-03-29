<?php

namespace Vixen\Enums\Tests\Samples;

use Vixen\Enums\HasLabels;

enum HasLabelsMissingAttributeEnum: int
{
    use HasLabels;

    case MissingLabel = 1;
}
