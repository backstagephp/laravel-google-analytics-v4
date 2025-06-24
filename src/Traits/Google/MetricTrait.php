<?php

namespace Backstage\Analytics\Traits\Google;

use Google\Analytics\Data\V1beta\Metric;

trait MetricTrait
{
    public array $metrics = [];

    public function addMetric(string $name): self
    {
        foreach ($this->metrics as $metric) {
            if ($metric->getName() === $name) {
                return $this;
            }
        }

        $this->metrics[] = new Metric([
            'name' => $name,
        ]);

        return $this;
    }

    public function addMetrics(string ...$metrics): self
    {
        foreach ($metrics as $metric) {
            $this->addMetric($metric);
        }

        return $this;
    }
}
