<?php

use Vixen\Enums\Tests\Samples\HasValuesEnum;
use Vixen\Enums\Tests\Samples\HasValuesIntEnum;

it('returns all values of a string-backed enum', function () {
    expect(HasValuesEnum::values()->toArray())->toBe([
        'value_1',
        'value_2',
        'value_3',
    ]);
});

it('returns all values of an int-backed enum', function () {
    expect(HasValuesIntEnum::values()->toArray())->toBe([0, 5]);
});
