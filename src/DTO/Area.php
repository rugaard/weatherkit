<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO;

use Illuminate\Support\Collection;

/**
 * Area.
 *
 * @package Rugaard\WeatherKit\DTO
 */
class Area extends AbstractDTO
{
    /**
     * Geometry type.
     *
     * @var string
     */
    protected string $type;

    /**
     * Collection of coordinates.
     *
     * @var \Illuminate\Support\Collection
     */
    protected Collection $coordinates;

    /**
     * Parse data.
     *
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function parse(array $data): void
    {
        $this->setType(type: $data['type'])
             ->setCoordinates(coordinates: $data['coordinates'][0] ?? []);
    }

    /**
     * Set geometry type.
     *
     * @param string $type
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get geometry type.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set coordinates
     *
     * @param array $coordinates
     * @return $this
     */
    public function setCoordinates(array $coordinates): self
    {
        $this->coordinates = Collection::make(items: $coordinates)->map(callback: static fn ($coordinates) => new Coordinate(data: ['latitude' => $coordinates[1], 'longitude' => $coordinates[0]]));
        return $this;
    }

    /**
     * Get coordinates.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCoordinates(): Collection
    {
        return $this->coordinates;
    }
}
