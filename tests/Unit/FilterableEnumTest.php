<?php

use Vixen\Enums\Tests\Samples\FilterableEnum;

it('returns only the specified cases', function () {
    $result = FilterableEnum::only(['NAME_1', 'NAME_3']);

    expect($result->values()->all())->toBe([
        FilterableEnum::NAME_1,
        FilterableEnum::NAME_3,
    ]);
});

it('returns an empty collection when no cases match', function () {
    expect(FilterableEnum::only([])->toArray())->toBe([]);
});

it('returns all cases except the specified ones', function () {
    $result = FilterableEnum::except(['NAME_2', 'NAME_4']);

    expect($result->values()->all())->toBe([
        FilterableEnum::NAME_1,
        FilterableEnum::NAME_3,
    ]);
});

it('returns all cases when excepting none', function () {
    $result = FilterableEnum::except([]);

    expect($result->values()->all())->toBe([
        FilterableEnum::NAME_1,
        FilterableEnum::NAME_2,
        FilterableEnum::NAME_3,
        FilterableEnum::NAME_4,
    ]);
});
