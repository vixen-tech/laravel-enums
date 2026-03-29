<?php

use Vixen\Enums\Tests\Samples\HasOptionsEnum;

it('returns a collection of labels and values', function () {
    expect(HasOptionsEnum::options()->toArray())->toBe([
        ['label' => 'Square', 'value' => 'square'],
        ['label' => 'Rectangle', 'value' => 'rect'],
    ]);
});

it('works alongside HasLabels without trait conflict', function () {
    expect(HasOptionsEnum::labels())->toBe([
        'square' => 'Square',
        'rect' => 'Rectangle',
    ])
        ->and(HasOptionsEnum::options()->toArray())->toBe([
            ['label' => 'Square', 'value' => 'square'],
            ['label' => 'Rectangle', 'value' => 'rect'],
        ]);
});
