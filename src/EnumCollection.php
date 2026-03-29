<?php

namespace Vixen\Enums;

use Illuminate\Support\Collection;
use InvalidArgumentException;

/**
 * @extends Collection<int, \BackedEnum>
 */
class EnumCollection extends Collection
{
    private const PROPERTY_FIELDS = ['value', 'name'];

    private const METHOD_FIELDS = ['label', 'shortLabel', 'longLabel', 'description'];

    public function toOptions(?array $only = null): Collection
    {
        $fields = $this->resolveFields(['label', 'value'], $only);

        return $this->map(fn ($case) => $this->buildCaseArray($case, $fields))->values();
    }

    public function toDescriptiveOptions(?array $only = null): Collection
    {
        $fields = $this->resolveFields(['label', 'value', 'description'], $only);

        return $this->map(fn ($case) => $this->buildCaseArray($case, $fields))->values();
    }

    /**
     * @param  array<string>  $defaults
     * @param  array<string>|null  $only
     * @return array<string>
     */
    private function resolveFields(array $defaults, ?array $only): array
    {
        if ($only === null) {
            return $defaults;
        }

        if ($only === ['*']) {
            $fields = ['value'];
            $first = $this->first();

            if ($first === null) {
                return $fields;
            }

            foreach (self::PROPERTY_FIELDS as $field) {
                if ($field !== 'value') {
                    $fields[] = $field;
                }
            }

            foreach (self::METHOD_FIELDS as $field) {
                if (method_exists($first, $field)) {
                    $fields[] = $field;
                }
            }

            return $fields;
        }

        $first = $this->first();
        $fields = ['value'];

        foreach ($only as $field) {
            if ($field === 'value') {
                continue;
            }

            if (in_array($field, self::PROPERTY_FIELDS)) {
                $fields[] = $field;

                continue;
            }

            if ($first !== null && ! method_exists($first, $field)) {
                throw new InvalidArgumentException("Field '{$field}' does not exist on ".get_class($first).'.');
            }

            $fields[] = $field;
        }

        return $fields;
    }

    private function buildCaseArray(\BackedEnum $case, array $fields): array
    {
        $result = [];

        foreach ($fields as $field) {
            if (in_array($field, self::PROPERTY_FIELDS)) {
                $result[$field] = $case->{$field};
            } else {
                $result[$field] = $case->{$field}();
            }
        }

        return $result;
    }
}
