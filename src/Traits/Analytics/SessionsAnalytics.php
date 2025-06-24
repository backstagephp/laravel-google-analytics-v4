<?php

namespace Backstage\Analytics\Traits\Analytics;

use Illuminate\Support\Arr;
use Backstage\Analytics\Period;

trait SessionsAnalytics
{
    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function sessions(Period $period): int
    {
        $googleAnalytics = $this->googleAnalytics
            ->setDateRange($period)
            ->addMetrics('sessions');

        $result = $this->getReport($googleAnalytics)
            ->dataTable;

        return (int) Arr::first(Arr::flatten($result));
    }

    public function sessionsPerPage(Period $period): array
    {
        $googleAnalytics = $this->googleAnalytics
            ->setDateRange($period)
            ->addMetrics('sessions')
            ->addDimensions('pagePath')
            ->keepEmptyRows(true);

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function averageSessionDuration(Period $period): float
    {
        $googleAnalytics = $this->googleAnalytics
            ->setDateRange($period)
            ->addMetrics('averageSessionDuration');

        $result = $this->getReport($googleAnalytics)
            ->dataTable;

        return (float) Arr::first(Arr::flatten($result));
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function averageSessionDurationByDate(Period $period): array
    {
        $googleAnalytics = $this->googleAnalytics
            ->setDateRange($period)
            ->addMetrics('averageSessionDuration')
            ->addDimensions('date')
            ->orderByDimension('date')
            ->keepEmptyRows(true);

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function averageSessionDurationInSecondsByPage(Period $period): array
    {
        $googleAnalytics = $this->googleAnalytics
            ->setDateRange($period)
            ->addMetrics('averageSessionDuration')
            ->addDimensions('pagePath');

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function averagePageViewsPerSession(Period $period): float
    {
        $googleAnalytics = $this->googleAnalytics
            ->setDateRange($period)
            ->addMetrics('screenPageViewsPerSession');

        $result = $this->getReport($googleAnalytics)
            ->dataTable;

        return (float) Arr::first(Arr::flatten($result));
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function averagePageViewsPerSessionByDate(Period $period): array
    {
        $googleAnalytics = $this->googleAnalytics
            ->setDateRange($period)
            ->addMetrics('screenPageViewsPerSession')
            ->addDimensions('date')
            ->orderByDimension('date')
            ->keepEmptyRows(true);

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function averageSessionDurationInSeconds(Period $period): float
    {
        $googleAnalytics = $this->googleAnalytics
            ->setDateRange($period)
            ->addMetrics('averageSessionDuration');

        $result = $this->getReport($googleAnalytics)
            ->dataTable;

        return (float) Arr::first(Arr::flatten($result));
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function averageSessionDurationInSecondsByDate(Period $period): array
    {
        $googleAnalytics = $this->googleAnalytics
            ->setDateRange($period)
            ->addMetrics('averageSessionDuration')
            ->addDimensions('date')
            ->orderByDimension('date')
            ->keepEmptyRows(true);

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function bounceRate(Period $period): float
    {
        $googleAnalytics = $this->googleAnalytics
            ->setDateRange($period)
            ->addMetrics('bounceRate');

        $result = $this->getReport($googleAnalytics)
            ->dataTable;

        return (float) Arr::first(Arr::flatten($result));
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function bounceRateByDate(Period $period): array
    {
        $googleAnalytics = $this->googleAnalytics
            ->setDateRange($period)
            ->addMetrics('bounceRate')
            ->addDimensions('date')
            ->orderByDimension('date')
            ->keepEmptyRows(true);

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function bounceRateByPage(Period $period): array
    {
        $googleAnalytics = $this->googleAnalytics
            ->setDateRange($period)
            ->addMetrics('bounceRate')
            ->addDimensions('pagePath')
            ->orderByDimension('bounceRate')
            ->keepEmptyRows(true);

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }
}
