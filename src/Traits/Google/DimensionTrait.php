<?php

namespace Backstage\Analytics\Traits\Google;

use Google\Analytics\Data\V1beta\Dimension;

trait DimensionTrait
{
    public array $dimensions = [];

    public function addDimension(string $name): self
    {
        $this->dimensions[] = new Dimension([
            'name' => $name,
        ]);

        return $this;
    }

    public function addDimensions(string ...$dimensions): self
    {
        foreach ($dimensions as $dimension) {
            $this->addDimension($dimension);
        }

        return $this;
    }
}
