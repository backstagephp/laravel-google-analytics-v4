<?php

namespace Vormkracht10\Analytics\Traits\Google;

use Google\Analytics\Data\V1beta\OrderBy;
use Google\Analytics\Data\V1beta\OrderBy\DimensionOrderBy;
use Google\Analytics\Data\V1beta\OrderBy\MetricOrderBy;
use Vormkracht10\Analytics\Enums\Direction;

trait OrderByTrait
{
    public array $orderBys = [];

    public function orderByDimension(string $name, Direction $direction = Direction::ASC): self
    {
        $dimension = new DimensionOrderBy([
            'dimension_name' => $name,
        ]);

        $this->orderBys = [
            (new OrderBy([
                'dimension' => $dimension,
            ]))->setDesc(Direction::DESC->value === $direction->value),
        ];

        return $this;
    }

    public function orderByMetric(string $name, Direction $direction = Direction::ASC): self
    {
        $metric = new MetricOrderBy([
            'metric_name' => $name,
        ]);

        $this->orderBys = [
            (new OrderBy([
                'metric' => $metric,
            ]))->setDesc(Direction::DESC->value === $direction->value),
        ];

        return $this;
    }
}
