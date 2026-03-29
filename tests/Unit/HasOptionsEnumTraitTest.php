<?php

use Vixen\Enums\Tests\Samples\HasOptionsEnum;

it('returns a collection of labels and values', function () {
    expect(HasOptionsEnum::options()->toArray())->toBe([
        ['label' => 'Square', 'value' => 'square'],
        ['label' => 'Rectangle', 'value' => 'rect'],
    ]);
});

it('works alongside HasLabels without trait conflict', function () {
    expect(HasOptionsEnum::labels()->toArray())->toBe([
        'square' => 'Square',
        'rect' => 'Rectangle',
    ])
        ->and(HasOptionsEnum::options()->toArray())->toBe([
            ['label' => 'Square', 'value' => 'square'],
            ['label' => 'Rectangle', 'value' => 'rect'],
        ]);
});

it('returns descriptive options', function () {
    expect(HasOptionsEnum::descriptiveOptions()->toArray())->toBe([
        ['label' => 'Square', 'value' => 'square', 'description' => null],
        ['label' => 'Rectangle', 'value' => 'rect', 'description' => null],
    ]);
});

it('returns options with only specified fields', function () {
    expect(HasOptionsEnum::options(only: ['label', 'description'])->toArray())->toBe([
        ['value' => 'square', 'label' => 'Square', 'description' => null],
        ['value' => 'rect', 'label' => 'Rectangle', 'description' => null],
    ]);
});

it('always includes value even when not in only list', function () {
    expect(HasOptionsEnum::options(only: ['label'])->toArray())->toBe([
        ['value' => 'square', 'label' => 'Square'],
        ['value' => 'rect', 'label' => 'Rectangle'],
    ]);
});

it('supports name field in only', function () {
    expect(HasOptionsEnum::options(only: ['name'])->toArray())->toBe([
        ['value' => 'square', 'name' => 'Square'],
        ['value' => 'rect', 'name' => 'Rect'],
    ]);
});

it('throws exception for invalid field', function () {
    HasOptionsEnum::options(only: ['nonExistentField']);
})->throws(InvalidArgumentException::class);
