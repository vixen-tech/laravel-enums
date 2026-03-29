<?php

use Vixen\Enums\Tests\Samples\ToValueEnum;
use Vixen\Enums\Tests\Samples\ToValueIntEnum;

it('returns the string value of an enum case', function () {
    expect(ToValueEnum::Active->toValue())->toBe('active')
        ->and(ToValueEnum::Inactive->toValue())->toBe('inactive');
});

it('returns the int value of an enum case', function () {
    expect(ToValueIntEnum::Admin->toValue())->toBe(5);
});
