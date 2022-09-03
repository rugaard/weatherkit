<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO;

/**
 * Source.
 *
 * @package Rugaard\WeatherKit\DTO
 */
class Source extends AbstractDTO
{
    /**
     * Name of source.
     *
     * @var string|null
     */
    protected ?string $name;

    /**
     * Name of source service.
     *
     * @var string|null
     */
    protected ?string $service;

    /**
     * Parse data.
     *
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function parse(array $data): void
    {
        $this->setName(name: $data['name'])
             ->setService(service: $data['service']);
    }

    /**
     * Set name of source.
     *
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name of source.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name of service.
     *
     * @param string|null $service
     * @return $this
     */
    public function setService(?string $service): self
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Get name of service.
     *
     * @return string|null
     */
    public function getService(): ?string
    {
        return $this->service;
    }
}
