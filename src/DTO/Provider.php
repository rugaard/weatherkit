<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO;

/**
 * Source.
 *
 * @package Rugaard\WeatherKit\DTO
 */
class Provider extends AbstractDTO
{
    /**
     * Name of provider.
     *
     * @var string|null
     */
    protected ?string $name;

    /**
     * URL to logo of provider.
     *
     * @var string|null
     */
    protected ?string $logoUrl;

    /**
     * Whether the provider is temporarily unavailable or not.
     *
     * @var bool
     */
    protected bool $isUnavailable;

    /**
     * Parse data.
     *
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function parse(array $data): void
    {
        $this->setName(name: $data['name'] ?? null)
             ->setLogoUrl(logoUrl: $data['logoUrl'] ?? null)
             ->setIsUnavailable(status: $data['unavailable'] ?? false);
    }

    /**
     * Set name of provider.
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
     * Get name of provider.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set URL to logo of provider.
     *
     * @param string|null $logoUrl
     * @return $this
     */
    public function setLogoUrl(?string $logoUrl): self
    {
        $this->logoUrl = $logoUrl;
        return $this;
    }

    /**
     * Get URL to logo of provider.
     *
     * @return string|null
     */
    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    /**
     * Set whether the provider is temporarily unavailable or not.
     *
     * @param bool $status
     * @return $this
     */
    public function setIsUnavailable(bool $status): self
    {
        $this->isUnavailable = $status;
        return $this;
    }

    /**
     * Get whether the provider is temporarily unavailable or not..
     *
     * @return bool
     */
    public function getIsUnavailable(): bool
    {
        return $this->isUnavailable;
    }
}
