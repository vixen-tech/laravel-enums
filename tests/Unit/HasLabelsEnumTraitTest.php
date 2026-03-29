<?php

use Vixen\Enums\Tests\Samples\EmptyEnum;
use Vixen\Enums\Tests\Samples\HasConvertedLabelsEnum;
use Vixen\Enums\Tests\Samples\HasLabelsEnum;
use Vixen\Enums\Tests\Samples\HasLabelsMissingAttributeEnum;
use Vixen\Enums\Tests\Samples\HasLongLabelsEnum;
use Vixen\Enums\Tests\Samples\HasShortLabelsEnum;
use Vixen\Enums\Tests\Samples\SingleCaseEnum;

it('returns all labels', function () {
    expect(HasLabelsEnum::labels())->toBe([
        HasLabelsEnum::Diamond->value => 'Diamond Shape',
        HasLabelsEnum::Heart->value => 'Heart Shape',
        HasLabelsEnum::Pyramid->value => 'Pyramid Shape',
    ]);
});

it('returns all long labels', function () {
    expect(HasLongLabelsEnum::longLabels())->toBe([
        HasLabelsEnum::Diamond->value => 'Diamond Shape',
        HasLabelsEnum::Heart->value => 'This is a heart shape',
        HasLabelsEnum::Pyramid->value => 'Pyramid',
    ]);
});

it('returns all short labels', function () {
    expect(HasShortLabelsEnum::shortLabels())->toBe([
        HasLabelsEnum::Diamond->value => 'Diamond',
        HasLabelsEnum::Heart->value => 'HRT',
        HasLabelsEnum::Pyramid->value => 'PRM',
    ]);
});

it('returns the correct label of indexed labels', function () {
    expect(HasLabelsEnum::Diamond->label())->toBe('Diamond Shape')
        ->and(HasLabelsEnum::Heart->label())->toBe('Heart Shape')
        ->and(HasLabelsEnum::Pyramid->label())->toBe('Pyramid Shape');
});

it('returns the long label', function () {
    expect(HasLongLabelsEnum::Diamond->longLabel())
        ->toBe('Diamond Shape');

    expect(HasLongLabelsEnum::Heart->longLabel())
        ->toBe('This is a heart shape');

    expect(HasLongLabelsEnum::Pyramid->longLabel())
        ->toBe('Pyramid');
});

it('returns the short label', function () {
    expect(HasShortLabelsEnum::Diamond->shortLabel())
        ->toBe('Diamond');

    expect(HasShortLabelsEnum::Heart->shortLabel())
        ->toBe('HRT');

    expect(HasShortLabelsEnum::Pyramid->shortLabel())
        ->toBe('PRM');
});

it('falls back to the case name if label was not specified', function () {
    expect(HasLabelsMissingAttributeEnum::MissingLabel->label())->toBe('Missing Label');
});

it('converts the label to title case', function () {
    expect(HasConvertedLabelsEnum::SquareShape->label())->toBe('Square Shape')
        ->and(HasConvertedLabelsEnum::RectangularShape->label())->toBe('Rectangular Shape');
});

it('returns empty arrays for an enum with no cases', function () {
    expect(EmptyEnum::labels())->toBe([])
        ->and(EmptyEnum::longLabels())->toBe([])
        ->and(EmptyEnum::shortLabels())->toBe([]);
});

it('works with a single-case enum', function () {
    expect(SingleCaseEnum::labels())->toBe(['only' => 'Only Option'])
        ->and(SingleCaseEnum::Only->label())->toBe('Only Option');
});

it('returns the same result from label() and labels()[$value]', function () {
    foreach (HasLabelsEnum::cases() as $case) {
        expect($case->label())->toBe(HasLabelsEnum::labels()[$case->value]);
    }
});
