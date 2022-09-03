<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DataSets;

use Illuminate\Support\Collection;
use Rugaard\WeatherKit\DTO\Forecasts\Hour;

/**
 * Hourly.
 *
 * @package Rugaard\WeatherKit\DataSet
 */
class Hourly extends AbstractDataSet
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
        $hours = Collection::make();

        foreach ($data['hours'] as $hour) {
            $hours->push(new Hour($hour, $this->timezone));
        }

        $this->data = $hours;
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
