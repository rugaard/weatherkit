<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO\Forecasts;

use Illuminate\Support\Collection;
use Rugaard\WeatherKit\DTO\Area;
use Rugaard\WeatherKit\DTO\Message;

/**
 * AlertDetails.
 *
 * @package Rugaard\WeatherKit\DTO\Forecasts
 */
class AlertDetails extends Alert
{
    /**
     * Area of which alert covers.
     *
     * @var \Rugaard\WeatherKit\DTO\Area
     */
    protected Area $area;

    /**
     * Collection of messages.
     *
     * @var \Illuminate\Support\Collection
     */
    protected Collection $messages;

    /**
     * Parse data.
     *
     * @param array $data
     * @return void
     * @throws \Exception
     */
    protected function parse(array $data): void
    {
        parent::parse($data);

        $this->setArea($data['area'])
             ->setMessages($data['messages']);
    }

    /**
     * Set area which alert covers.
     *
     * @param array $area
     * @return $this
     */
    public function setArea(array $area): self
    {
        $this->area = new Area($area['features'][0]['geometry'] ?? []);
        return $this;
    }

    /**
     * Get area which alert covers.
     *
     * @return \Rugaard\WeatherKit\DTO\Area
     */
    public function getArea(): Area
    {
        return $this->area;
    }

    /**
     * Set messages.
     *
     * @param array $messages
     * @return $this
     */
    public function setMessages(array $messages): self
    {
        $this->messages = Collection::make($messages)->map(fn ($message) => new Message($message));
        return $this;
    }

    /**
     * Get messages.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }
}
