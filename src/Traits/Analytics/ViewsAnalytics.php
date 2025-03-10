<?php

namespace Vormkracht10\Analytics\Traits\Analytics;

use Illuminate\Support\Arr;
use Vormkracht10\Analytics\Enums\Direction;
use Vormkracht10\Analytics\Period;

trait ViewsAnalytics
{
    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function totalViews(Period $period): int
    {
        $googleAnalytics = $this->googleAnalytics->setDateRange($period)
            ->addMetrics('screenPageViews');

        $result = $this->getReport($googleAnalytics)
            ->dataTable;

        return (int) Arr::first(Arr::flatten($result));
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function totalViewsByDate(Period $period): array
    {
        $googleAnalytics = $this->googleAnalytics->setDateRange($period)
            ->addMetrics('screenPageViews')
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
    public function totalViewsByPage(Period $period): array
    {
        $googleAnalytics = $this->googleAnalytics->setDateRange($period)
            ->addMetrics('screenPageViews')
            ->addDimensions('pageTitle', 'fullPageUrl');

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function topViewsByPage(Period $period): array
    {
        return $this->getViewsByPage($period, Direction::DESC);
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function leastViewsByPage(Period $period): array
    {
        return $this->getViewsByPage($period, Direction::ASC);
    }

    private function getViewsByPage(Period $period, Direction $direction): array
    {
        $googleAnalytics = $this->googleAnalytics->setDateRange($period)
            ->addMetrics('screenPageViews')
            ->addDimensions('pageTitle', 'fullPageUrl')
            ->orderByMetric('screenPageViews', $direction);

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function totalViewsByPagePath(Period $period): array
    {
        $googleAnalytics = $this->googleAnalytics->setDateRange($period)
            ->addMetrics('screenPageViews')
            ->addDimensions('pagePath');

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }
    
    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function getViewsPageByPathUrl(Period $period, string $pagePath): array
    {
        try{
            $googleAnalytics = $this->googleAnalytics
                ->setDateRange($period)
                ->addMetrics('screenPageViews')
                ->addDimensions('pagePath')
                ->whereDimension('pagePath',4,$pagePath,true);

            return $this->getReport($googleAnalytics)
                ->dataTable;

        } catch (Throwable $e) {

            Log::channel('google')->info('Erreur API get '. $entityCode);
            Log::channel('google')->info('Exception: '. $e);
            report($e);
            return false;

        }
    }
    
    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function topViewsByPagePath(Period $period, int $limit = 10): array
    {
        $googleAnalytics = $this->googleAnalytics->setDateRange($period)
            ->addMetrics('screenPageViews')
            ->addDimensions('pagePath')
            ->orderByMetric('screenPageViews', Direction::DESC)
            ->limit($limit);

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function totalViewsByPageTitle(Period $period): array
    {
        $googleAnalytics = $this->googleAnalytics->setDateRange($period)
            ->addMetrics('screenPageViews')
            ->addDimensions('pageTitle');

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function topViewsByPageTitle(Period $period, int $limit = 10): array
    {
        $googleAnalytics = $this->googleAnalytics->setDateRange($period)
            ->addMetrics('screenPageViews')
            ->addDimensions('pageTitle', 'pagePath')
            ->orderByMetric('screenPageViews', Direction::DESC)
            ->limit($limit);

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function totalViewsByPageUrl(Period $period): array
    {
        $googleAnalytics = $this->googleAnalytics->setDateRange($period)
            ->addMetrics('screenPageViews')
            ->addDimensions('fullPageUrl');

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function topViewsByPageUrl(Period $period, int $limit = 10): array
    {
        $googleAnalytics = $this->googleAnalytics->setDateRange($period)
            ->addMetrics('screenPageViews')
            ->addDimensions('fullPageUrl')
            ->orderByMetric('screenPageViews', Direction::DESC)
            ->limit($limit);

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function totalViewsByCountry(Period $period): array
    {
        $googleAnalytics = $this->googleAnalytics->setDateRange($period)
            ->addMetrics('screenPageViews')
            ->addDimensions('country');

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function topViewsByCountry(Period $period, int $limit = 10): array
    {
        $googleAnalytics = $this->googleAnalytics->setDateRange($period)
            ->addMetrics('screenPageViews')
            ->addDimensions('country')
            ->orderByMetric('screenPageViews', Direction::DESC)
            ->limit($limit);

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function totalViewsByCity(Period $period): array
    {
        $googleAnalytics = $this->googleAnalytics->setDateRange($period)
            ->addMetrics('screenPageViews')
            ->addDimensions('city');

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }

    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function topViewsByCity(Period $period, int $limit = 10): array
    {
        $googleAnalytics = $this->googleAnalytics->setDateRange($period)
            ->addMetrics('screenPageViews')
            ->addDimensions('city')
            ->orderByMetric('screenPageViews', Direction::DESC)
            ->limit($limit);

        return $this->getReport($googleAnalytics)
            ->dataTable;
    }
}
