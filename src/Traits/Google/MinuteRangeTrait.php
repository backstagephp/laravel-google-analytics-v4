<?php

namespace Backstage\Analytics\Traits\Google;

use Google\Analytics\Data\V1beta\MinuteRange;

trait MinuteRangeTrait
{
    public array $minuteRanges = [];

    public function setMinuteRange(?string $name, ?int $start, ?int $end): self
    {
        $this->minuteRanges = [
            new MinuteRange([
                'name' => $name,
                'start_minutes_ago' => $start,
                'end_minutes_ago' => $end,
            ]),
        ];

        return $this;
    }

    public function setMinuteRanges(array ...$items): self
    {
        $this->minuteRanges = [];

        foreach ($items as $item) {
            $this->minuteRanges[] = new MinuteRange([
                'name' => $item['name'],
                'start_minutes_ago' => $item['start'],
                'end_minutes_ago' => $item['end'],
            ]);
        }

        return $this;
    }

    private function validateStartAndEnd(?int $start, ?int $end): void
    {
        if ($start > $end) {
            throw new \Exception('Start cannot be greater than end');
        }
    }
}
