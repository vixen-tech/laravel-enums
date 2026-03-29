<?php

use Vixen\Enums\EnumCollection;
use Vixen\Enums\Tests\Samples\HasDescriptionsEnum;

it('converts enum cases to options with label and value', function () {
    $collection = new EnumCollection(HasDescriptionsEnum::cases());

    expect($collection->toOptions()->toArray())->toBe([
        ['label' => 'Diamond', 'value' => 'diamond'],
        ['label' => 'Heart', 'value' => 'heart'],
        ['label' => 'Pyramid', 'value' => 'pyramid'],
    ]);
});

it('converts enum cases to descriptive options with label, value, and description', function () {
    $collection = new EnumCollection(HasDescriptionsEnum::cases());

    expect($collection->toDescriptiveOptions()->toArray())->toBe([
        ['label' => 'Diamond', 'value' => 'diamond', 'description' => 'A precious stone of crystallized carbon'],
        ['label' => 'Heart', 'value' => 'heart', 'description' => 'A vital organ that pumps blood'],
        ['label' => 'Pyramid', 'value' => 'pyramid', 'description' => null],
    ]);
});

it('works with Filterable::only()', function () {
    $result = HasDescriptionsEnum::only(['Diamond', 'Pyramid']);

    expect($result)->toBeInstanceOf(EnumCollection::class)
        ->and($result->toOptions()->toArray())->toBe([
            ['label' => 'Diamond', 'value' => 'diamond'],
            ['label' => 'Pyramid', 'value' => 'pyramid'],
        ]);
});

it('works with Filterable::except()', function () {
    $result = HasDescriptionsEnum::except(['Heart']);

    expect($result)->toBeInstanceOf(EnumCollection::class)
        ->and($result->toDescriptiveOptions()->toArray())->toBe([
            ['label' => 'Diamond', 'value' => 'diamond', 'description' => 'A precious stone of crystallized carbon'],
            ['label' => 'Pyramid', 'value' => 'pyramid', 'description' => null],
        ]);
});

it('supports only parameter on toOptions', function () {
    $collection = new EnumCollection(HasDescriptionsEnum::cases());

    expect($collection->toOptions(only: ['label', 'description'])->toArray())->toBe([
        ['value' => 'diamond', 'label' => 'Diamond', 'description' => 'A precious stone of crystallized carbon'],
        ['value' => 'heart', 'label' => 'Heart', 'description' => 'A vital organ that pumps blood'],
        ['value' => 'pyramid', 'label' => 'Pyramid', 'description' => null],
    ]);
});

it('supports only parameter on toDescriptiveOptions', function () {
    $collection = new EnumCollection(HasDescriptionsEnum::cases());

    expect($collection->toDescriptiveOptions(only: ['label'])->toArray())->toBe([
        ['value' => 'diamond', 'label' => 'Diamond'],
        ['value' => 'heart', 'label' => 'Heart'],
        ['value' => 'pyramid', 'label' => 'Pyramid'],
    ]);
});

it('supports wildcard only parameter', function () {
    $collection = new EnumCollection(HasDescriptionsEnum::cases());
    $result = $collection->toOptions(only: ['*'])->toArray();

    // Should include value, name, and all available methods
    expect($result[0])->toHaveKeys(['value', 'name', 'label', 'description']);
    expect($result[0]['value'])->toBe('diamond');
    expect($result[0]['name'])->toBe('Diamond');
    expect($result[0]['label'])->toBe('Diamond');
    expect($result[0]['description'])->toBe('A precious stone of crystallized carbon');
});

it('throws exception for invalid field on toOptions', function () {
    $collection = new EnumCollection(HasDescriptionsEnum::cases());

    $collection->toOptions(only: ['nonExistent']);
})->throws(InvalidArgumentException::class);

it('throws exception for invalid field on toDescriptiveOptions', function () {
    $collection = new EnumCollection(HasDescriptionsEnum::cases());

    $collection->toDescriptiveOptions(only: ['fakeField']);
})->throws(InvalidArgumentException::class);

it('handles empty collection with wildcard', function () {
    $collection = new EnumCollection([]);

    expect($collection->toOptions(only: ['*'])->toArray())->toBe([]);
});

it('always includes value even when not specified in only', function () {
    $collection = new EnumCollection(HasDescriptionsEnum::cases());

    expect($collection->toOptions(only: ['description'])->toArray())->toBe([
        ['value' => 'diamond', 'description' => 'A precious stone of crystallized carbon'],
        ['value' => 'heart', 'description' => 'A vital organ that pumps blood'],
        ['value' => 'pyramid', 'description' => null],
    ]);
});
