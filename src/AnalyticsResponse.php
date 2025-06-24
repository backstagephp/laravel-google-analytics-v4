<?php

namespace Backstage\Analytics;

use Google\Analytics\Data\V1beta\RunRealtimeReportResponse;
use Google\Analytics\Data\V1beta\RunReportResponse;

class AnalyticsResponse
{
    public RunReportResponse|RunRealtimeReportResponse $response;

    public array $dataTable;

    public array $metricAggregationsTable;

    public function setResponse(RunReportResponse|RunRealtimeReportResponse $response): self
    {
        $this->response = $response;

        return $this;
    }

    public function setDataTable(array $dataTable): self
    {
        $this->dataTable = $dataTable;

        return $this;
    }

    public function setMetricAggregationsTable(array $metricAggregationsTable): self
    {
        $this->metricAggregationsTable = $metricAggregationsTable;

        return $this;
    }
}
