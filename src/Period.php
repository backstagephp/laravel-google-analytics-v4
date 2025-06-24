<?php

namespace Backstage\Analytics;

use Illuminate\Support\Carbon;
use Backstage\Analytics\Exceptions\InvalidPeriod;

class Period
{
    public Carbon $startDate;

    public Carbon $endDate;

    final public function __construct(Carbon $startDate, Carbon $endDate)
    {
        if ($startDate->greaterThan($endDate)) {
            throw InvalidPeriod::startDateCannotBeGreaterThanEndDate($startDate, $endDate);
        }

        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public static function make(Carbon $startDate, Carbon $endDate): self
    {
        return new self($startDate, $endDate);
    }

    public static function days(int $days): self
    {
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays($days);

        return new self($startDate, $endDate);
    }

    public static function weeks(int $weeks): self
    {
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subWeeks($weeks)->startOfDay();

        return new self($startDate, $endDate);
    }

    public static function months(int $months): self
    {
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subMonths($months)->startOfDay();

        return new self($startDate, $endDate);
    }

    public static function years(int $years): self
    {
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subYears($years)->startOfDay();

        return new self($startDate, $endDate);
    }

    public static function since(Carbon $startDate): self
    {
        return new self($startDate, Carbon::today());
    }

    public static function hours(int $hours): self
    {
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subHours($hours);

        return new self($startDate, $endDate);
    }

    public static function minutes(int $minutes): self
    {
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subMinutes($minutes);

        return new self($startDate, $endDate);
    }
}
