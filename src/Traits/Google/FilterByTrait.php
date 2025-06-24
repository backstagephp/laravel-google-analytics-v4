<?php

namespace Backstage\Analytics\Traits\Google;

use Google\Analytics\Data\V1beta\Filter;
use Google\Analytics\Data\V1beta\Filter\BetweenFilter;
use Google\Analytics\Data\V1beta\Filter\InListFilter;
use Google\Analytics\Data\V1beta\Filter\NumericFilter;
use Google\Analytics\Data\V1beta\Filter\StringFilter;
use Google\Analytics\Data\V1beta\FilterExpression;
use Google\Analytics\Data\V1beta\FilterExpressionList;
use Google\Analytics\Data\V1beta\NumericValue;

trait FilterByTrait
{
    public ?FilterExpression $dimensionFilter = null;

    public ?FilterExpression $metricFilter = null;

    public function whereDimension(string $field, int $matchType, int|string|float $value, bool $caseSensitive = false): self
    {
        $string = new StringFilter([
            'match_type' => $matchType,
            'value' => $value,
            'case_sensitive' => $caseSensitive,
        ]);

        $filter = new Filter([
            'string_filter' => $string,
            'field_name' => $field,
        ]);

        $this->dimensionFilter = new FilterExpression([
            'filter' => $filter,
        ]);

        return $this;
    }

    public function whereDimensionIn(string $field, array $values, bool $caseSensitive = false): self
    {
        $inList = new InListFilter([
            'values' => $values,
            'case_sensitive' => $caseSensitive,
        ]);

        $filter = new Filter([
            'in_list_filter' => $inList,
            'field_name' => $field,
        ]);

        $this->dimensionFilter = new FilterExpression([
            'filter' => $filter,
        ]);

        return $this;
    }

    public function whereAndGroupDimensions(array $dimensions): self
    {
        $this->dimensionFilter = new FilterExpression([
            'and_group' => new FilterExpressionList([
                'expressions' => $this->createDimensionGroup($dimensions),
            ]),
        ]);

        return $this;
    }

    public function createDimensionGroup(array $dimensions): array
    {
        $list = [];

        foreach ($dimensions as $dimension) {
            $string = new StringFilter([
                'match_type' => $dimension[3] ?? false,
                'value' => $dimension[2],
                'case_sensitive' => $dimension[1],
            ]);

            $filter = new Filter([
                'string_filter' => $string,
                'field_name' => $dimension[0],
            ]);

            $list[] = new FilterExpression([
                'filter' => $filter,
            ]);
        }

        return $list;
    }

    public function whereMetric(string $field, int $operation, int|string|float $value): self
    {
        $numeric = new NumericFilter([
            'operation' => $operation,
            'value' => $this->getNumeric($value),
        ]);

        $filter = new Filter([
            'numeric_filter' => $numeric,
            'field_name' => $field,
        ]);

        $this->metricFilter = new FilterExpression([
            'filter' => $filter,
        ]);

        return $this;
    }

    public function whereMetricBetween(string $field, int|string|float $from, int|string|float $to): self
    {
        $between = new BetweenFilter([
            'from_value' => $this->getNumeric($from),
            'to_value' => $this->getNumeric($to),
        ]);

        $filter = new Filter([
            'between_filter' => $between,
            'field_name' => $field,
        ]);

        $this->metricFilter = new FilterExpression([
            'filter' => $filter,
        ]);

        return $this;
    }

    private function getNumeric(int|string|float $value): NumericValue
    {
        $numeric = new NumericValue;

        if (is_float($value)) {
            $numeric->setDoubleValue($value);

            return $numeric;
        }

        $numeric->setInt64Value($value);

        return $numeric;
    }
}
