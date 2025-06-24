<?php

namespace Backstage\Analytics\Traits\Google;

trait RowConfigTrait
{
    public ?bool $keepEmptyRows = null;

    public ?int $limit = null;

    public ?int $offset = null;

    public function keepEmptyRows(bool $keepEmptyRows = false): self
    {
        $this->keepEmptyRows = $keepEmptyRows;

        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function offset(int $offset): self
    {
        $this->offset = $offset;

        return $this;
    }
}
