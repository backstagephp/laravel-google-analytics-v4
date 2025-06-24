<?php

namespace Backstage\Analytics\Service;

use Backstage\Analytics\Traits\Google\DateRangeTrait;
use Backstage\Analytics\Traits\Google\DimensionTrait;
use Backstage\Analytics\Traits\Google\FilterByTrait;
use Backstage\Analytics\Traits\Google\MetricAggregationTrait;
use Backstage\Analytics\Traits\Google\MetricTrait;
use Backstage\Analytics\Traits\Google\MinuteRangeTrait;
use Backstage\Analytics\Traits\Google\OrderByTrait;
use Backstage\Analytics\Traits\Google\RowConfigTrait;
use Backstage\Analytics\Traits\ResponseFormatterTrait;

class GoogleAnalyticsService
{
    use DateRangeTrait,
        DimensionTrait,
        FilterByTrait,
        MetricAggregationTrait,
        MetricTrait,
        MinuteRangeTrait,
        OrderByTrait,
        ResponseFormatterTrait,
        RowConfigTrait;
}
