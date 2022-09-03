<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DataSets;

use Illuminate\Support\Collection;
use Rugaard\WeatherKit\DTO\Forecasts\Day;

/**
 * Daily.
 *
 * @package Rugaard\WeatherKit\DataSet
 */
class Daily extends AbstractDataSet
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
        $days = Collection::make();

        foreach ($data['days'] as $day) {
            $days->push(new Day($day, $this->timezone));
        }

        $this->data = $days;
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
