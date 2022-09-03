<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO;

/**
 * Message.
 *
 * @package Rugaard\WeatherKit\DTO
 */
class Message extends AbstractDTO
{
    /**
     * Language code.
     *
     * @var string
     */
    protected string $language;

    /**
     * Text message.
     *
     * @var string
     */
    protected string $text;

    /**
     * Parse data.
     *
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function parse(array $data): void
    {
        $this->setLanguage(language: $data['language'])
             ->setText(text: $data['text']);
    }

    /**
     * Set language.
     *
     * @param string $language
     * @return $this
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;
        return $this;
    }

    /**
     * Get language.
     *
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * Set text message
     *
     * @param string $text
     * @return $this
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Get text message
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
}
