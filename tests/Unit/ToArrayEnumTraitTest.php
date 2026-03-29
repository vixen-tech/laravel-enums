<?php

use Vixen\Enums\Tests\Samples\ArrayableEnum;

it('converts an enum case into an array', function () {
    $enum = ArrayableEnum::Member;

    expect($enum->toArray())->toBe([
        'label' => __('Member'),
        'value' => 0,
    ]);
});
