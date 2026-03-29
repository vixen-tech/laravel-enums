<?php

use Vixen\Enums\Tests\Samples\HasDescriptionsEnum;

it('returns all descriptions as a collection', function () {
    expect(HasDescriptionsEnum::descriptions()->toArray())->toBe([
        'diamond' => 'A precious stone of crystallized carbon',
        'heart' => 'A vital organ that pumps blood',
        'pyramid' => null,
    ]);
});

it('returns the description for a single case', function () {
    expect(HasDescriptionsEnum::Diamond->description())
        ->toBe('A precious stone of crystallized carbon');

    expect(HasDescriptionsEnum::Heart->description())
        ->toBe('A vital organ that pumps blood');
});

it('returns null when no description attribute is present', function () {
    expect(HasDescriptionsEnum::Pyramid->description())->toBeNull();
});

it('returns the same result from description() and descriptions()[$value]', function () {
    foreach (HasDescriptionsEnum::cases() as $case) {
        expect($case->description())->toBe(HasDescriptionsEnum::descriptions()[$case->value]);
    }
});

it('returns options with description', function () {
    expect(HasDescriptionsEnum::optionsWithDescription()->toArray())->toBe([
        ['label' => 'Diamond', 'value' => 'diamond', 'description' => 'A precious stone of crystallized carbon'],
        ['label' => 'Heart', 'value' => 'heart', 'description' => 'A vital organ that pumps blood'],
        ['label' => 'Pyramid', 'value' => 'pyramid', 'description' => null],
    ]);
});
