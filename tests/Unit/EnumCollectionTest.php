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
