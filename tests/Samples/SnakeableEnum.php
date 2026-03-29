<?php

namespace Vixen\Enums\Tests\Samples;

use Vixen\Enums\Snakeable;

enum SnakeableEnum
{
    use Snakeable;

    case One;
    case SecondNumber;
    case ThirdAndLastNumber;
}
