<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DataSets;

use Illuminate\Support\Collection;
use Rugaard\WeatherKit\DTO\Forecasts\Minute;
use Rugaard\WeatherKit\DTO\Measurements\Precipitation;
use Rugaard\WeatherKit\DTO\TimePeriod;
use Rugaard\WeatherKit\Enums\Precipitation as PrecipitationType;

/**
 * NextHour.
 *
 * @package Rugaard\WeatherKit\DataSet
 */
class NextHour extends AbstractDataSet
{
    /**
     * Forecast time.
     *
     * @var \Rugaard\WeatherKit\DTO\TimePeriod
     */
    protected TimePeriod $forecastTime;

    /**
     * Summarized precipitation.
     *
     * @var \Illuminate\Support\Collection
     */
    protected Collection $precipitation;

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
        // Summarized data.
        $this->precipitation = Collection::make([
            'type' => PrecipitationType::tryFrom($data['summary'][0]['condition']),
            'chance' => (float) $data['summary'][0]['precipitationChance'] * 100,
            'intensity' => new Precipitation(['value' => $data['summary'][0]['precipitationIntensity']])
        ]);

        // Forecast period
        $this->forecastTime = new TimePeriod(['start' => $data['forecastStart'], 'end' => $data['forecastEnd']], $this->timezone);

        // Collection of minutes.
        $minutes = Collection::make();

        foreach ($data['minutes'] as $minute) {
            $minutes->push(new Minute($minute, $this->timezone));
        }

        $this->data = $minutes;
    }

    /**
     * Get forecast time.
     *
     * @return \Rugaard\WeatherKit\DTO\TimePeriod
     */
    public function getForecastTime(): TimePeriod
    {
        return $this->forecastTime;
    }

    /**
     * Get precipitation.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getPrecipitation(): Collection
    {
        return $this->precipitation;
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
