<?php

namespace Backstage\Analytics\Traits\Google;

trait MetricAggregationTrait
{
    public array $metricAggregations = [];

    public function setMetricAggregation(int $value): self
    {
        $this->metricAggregations = [
            $value,
        ];

        return $this;
    }

    public function setMetricAggregations(int ...$values): self
    {
        $this->metricAggregations = $values;

        return $this;
    }
}
