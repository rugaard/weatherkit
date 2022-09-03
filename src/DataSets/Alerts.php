<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DataSets;

use Illuminate\Support\Collection;
use Rugaard\WeatherKit\DTO\Forecasts\Alert;

/**
 * Alerts.
 *
 * @package Rugaard\WeatherKit\DataSet
 */
class Alerts extends AbstractDataSet
{
    /**
     * Collection of data.
     *
     * @var \Illuminate\Support\Collection
     */
    protected Collection $data;

    /**
     * Parse data set.
     *
     * @param array $data
     * @return void
     * @throws \Exception
     */
    protected function parse(array $data): void
    {
        $alerts = Collection::make();

        foreach ($data['alerts'] as $alert) {
            $alerts->push(new Alert($alert, $this->timezone));
        }

        $this->data = $alerts;
    }

    /**
     * Get data collection.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getData(): Collection
    {
        return $this->data;
    }
}
