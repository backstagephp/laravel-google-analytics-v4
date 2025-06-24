<?php

namespace Backstage\Analytics\Traits\Analytics;

use Backstage\Analytics\Period;
use Illuminate\Support\Arr;

trait RealtimeAnalytics
{
    /**
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function activeUsers(?Period $period = null, ?string $path = null): int|array
    {
        if (is_null($period)) {
            $period = Period::minutes(30);
        }

        $googleAnalytics = $this->googleAnalytics
            ->setMinuteRange(
                name: null,
                start: 29,
                end: 0,
            )
            ->addMetrics('activeUsers');

        if ($path) {
            // Filter by path is not possible yet on the Realtime API. Currently it is only possible to filter by unifiedScreenName.
            // @see https://stackoverflow.com/a/70684184/7603806
            // @see https://developers.google.com/analytics/devguides/reporting/data/v1/realtime-api-schema#dimensions
            $googleAnalytics->addDimension('unifiedScreenName');

            return $this->getRealtimeReport($googleAnalytics)
                ->dataTable;
        }

        $result = $this->getRealtimeReport($googleAnalytics)
            ->dataTable;

        return (int) Arr::first(Arr::flatten($result));
    }
}
