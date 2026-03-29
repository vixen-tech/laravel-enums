# Laravel Enums

A collection of composable traits and attributes for working with PHP backed enums in Laravel.

## Requirements

- PHP 8.3+
- Laravel 11, 12, or 13

## Installation

```bash
composer require vixen/laravel-enums
```

## Usage

Add any combination of traits to your backed enum:

```php
use Vixen\Enums\Attributes\Description;
use Vixen\Enums\Attributes\Label;
use Vixen\Enums\Attributes\LongLabel;
use Vixen\Enums\Attributes\ShortLabel;
use Vixen\Enums\HasDescriptions;
use Vixen\Enums\HasLabels;
use Vixen\Enums\HasOptions;
use Vixen\Enums\HasValues;
use Vixen\Enums\Filterable;
use Vixen\Enums\Snakeable;
use Vixen\Enums\ToArray;
use Vixen\Enums\ToValue;

enum Status: string
{
    use HasDescriptions;
    use HasLabels;
    use HasOptions;
    use HasValues;
    use Filterable;
    use Snakeable;
    use ToArray;
    use ToValue;

    #[Label('Pending')]
    #[LongLabel('Pending Review')]
    #[ShortLabel('PND')]
    #[Description('Items waiting to be reviewed by an administrator')]
    case Pending = 'pending';

    #[Label('Approved')]
    #[LongLabel('Approved Review')]
    #[ShortLabel('APR')]
    #[Description('Items that have passed review')]
    case Approved = 'approved';

    #[Label('Rejected'), LongLabel('Rejected Review'), ShortLabel('REJ')]
    case Rejected = 'rejected';
}
```

## Traits

### HasLabels

Provides label functionality using `#[Label]`, `#[LongLabel]`, and `#[ShortLabel]` attributes.

```php
// Static methods — return a Collection keyed by enum value
Status::labels();      // ['pending' => 'Pending', 'approved' => 'Approved', ...]
Status::longLabels();  // ['pending' => 'Pending Review', ...]
Status::shortLabels(); // ['pending' => 'PND', ...]

// Instance methods — return the label for a single case
Status::Pending->label();      // 'Pending'
Status::Pending->longLabel();  // 'Pending Review'
Status::Pending->shortLabel(); // 'PND'
```

When no attribute is provided, a label is auto-generated from the case name:

```php
case Pending = 'pending';
// Pending->label() returns 'Pending'
```

#### Label type parameter

Instead of separate attributes, you can use the `type` parameter on `#[Label]`:

```php
#[Label('Pending')]                        // default label
#[Label('Pending Review', type: 'long')]   // equivalent to #[LongLabel(...)]
#[Label('PND', type: 'short')]             // equivalent to #[ShortLabel(...)]
```

#### Fallback chain

When requesting a specific label type (e.g., `longLabel()`), the resolution order is:

1. The exact attribute (`#[LongLabel]` or `#[Label(..., type: 'long')]`)
2. The default `#[Label]`
3. Auto-generated label from the case name

#### Translation support

`#[Label]` and `#[LongLabel]` values are passed through Laravel's `__()` helper, so you can use translation keys:

```php
#[Label('enums.status.pending')]
case Pending = 'pending';
```

`#[ShortLabel]` returns the raw string without translation, since it's intended for abbreviations.

### HasDescriptions

Provides description functionality using the `#[Description]` attribute. Useful for longer descriptive text alongside labels.

```php
// Static method — returns a Collection keyed by enum value
Status::descriptions();
// ['pending' => 'Items waiting to be reviewed by an administrator', 'approved' => 'Items that have passed review', 'rejected' => null]

// Instance method — returns the description for a single case, or null
Status::Pending->description();     // 'Items waiting to be reviewed by an administrator'
Status::Rejected->description();    // null
```

Returns `null` when no `#[Description]` attribute is present on a case.

#### Translation support

`#[Description]` values are passed through Laravel's `__()` helper, so you can use translation keys:

```php
#[Description('enums.status.pending_description')]
case Pending = 'pending';
```

### HasOptions

Returns label-value pairs as a Collection, useful for select dropdowns and form components. Requires the enum to provide a `label()` method (typically via `HasLabels`) and a `description()` method (typically via `HasDescriptions`).

```php
Status::options();
// [
//     ['label' => 'Pending', 'value' => 'pending'],
//     ['label' => 'Approved', 'value' => 'approved'],
//     ['label' => 'Rejected', 'value' => 'rejected'],
// ]

Status::optionsWithDescription();
// [
//     ['label' => 'Pending', 'value' => 'pending', 'description' => 'Items waiting to be reviewed by an administrator'],
//     ['label' => 'Approved', 'value' => 'approved', 'description' => 'Items that have passed review'],
//     ['label' => 'Rejected', 'value' => 'rejected', 'description' => null],
// ]
```

### HasValues

Returns a Collection of all backed values.

```php
Status::values(); // ['pending', 'approved', 'rejected']
```

### Filterable

Select or exclude specific cases by name. Returns an `EnumCollection` (see below), so you can chain `toOptions()` or `toDescriptiveOptions()` directly.

```php
Status::only(['Pending', 'Approved']);
// EnumCollection of [Status::Pending, Status::Approved]

Status::except(['Rejected']);
// EnumCollection of [Status::Pending, Status::Approved]

// Chain with EnumCollection methods
Status::only(['Pending', 'Approved'])->toOptions();
// [
//     ['label' => 'Pending', 'value' => 'pending'],
//     ['label' => 'Approved', 'value' => 'approved'],
// ]
```

### EnumCollection

A custom collection class extending Laravel's `Collection`, designed to hold enum cases and provide convenient conversion methods.

```php
use Vixen\Enums\EnumCollection;

$collection = new EnumCollection(Status::cases());

$collection->toOptions();
// [
//     ['label' => 'Pending', 'value' => 'pending'],
//     ['label' => 'Approved', 'value' => 'approved'],
//     ['label' => 'Rejected', 'value' => 'rejected'],
// ]

$collection->toDescriptiveOptions();
// [
//     ['label' => 'Pending', 'value' => 'pending', 'description' => 'Items waiting to be reviewed by an administrator'],
//     ['label' => 'Approved', 'value' => 'approved', 'description' => 'Items that have passed review'],
//     ['label' => 'Rejected', 'value' => 'rejected', 'description' => null],
// ]
```

`toOptions()` requires the enum to use `HasLabels`. `toDescriptiveOptions()` additionally requires `HasDescriptions`.

Returned automatically by `Filterable::only()` and `Filterable::except()`.

### Snakeable

Converts the case name to snake_case.

```php
Status::Pending->snake();       // 'pending'
Status::PendingReview->snake(); // 'pending_review'
```

### ToArray

Converts a single case to an associative array. Requires the enum to provide a `label()` method.

```php
Status::Pending->toArray();
// ['label' => 'Pending', 'value' => 'pending']
```

### ToValue

Explicit accessor for the backed value.

```php
Status::Pending->toValue(); // 'pending'
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Alex Torscho](https://alextorscho.com)
- All Contributors

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
