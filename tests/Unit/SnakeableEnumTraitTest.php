<?php

use Vixen\Enums\Tests\Samples\SnakeableEnum;

it('converts enum case name to a snake case', function () {
    expect(SnakeableEnum::One->snake())->toBe('one')
        ->and(SnakeableEnum::SecondNumber->snake())->toBe('second_number')
        ->and(SnakeableEnum::ThirdAndLastNumber->snake())->toBe('third_and_last_number');
});
