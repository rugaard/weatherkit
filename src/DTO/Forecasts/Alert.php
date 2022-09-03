<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO\Forecasts;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Collection;
use Rugaard\WeatherKit\DTO\AbstractDTO;
use Rugaard\WeatherKit\DTO\Source;
use Rugaard\WeatherKit\DTO\TimePeriod;
use Rugaard\WeatherKit\Enums\Action;
use Rugaard\WeatherKit\Enums\Certainty;
use Rugaard\WeatherKit\Enums\Importance;
use Rugaard\WeatherKit\Enums\Severity;
use Rugaard\WeatherKit\Enums\Urgency;

/**
 * Alert.
 *
 * @package Rugaard\WeatherKit\DTO\Forecasts
 */
class Alert extends AbstractDTO
{
    /**
     * Timezone of data.
     *
     * @var \DateTimeZone
     */
    protected DateTimeZone $timezone;

    /**
     * Weather alert UUID.
     *
     * @var string
     */
    protected string $id;

    /**
     * Area ID.
     *
     * @var string
     */
    protected string $areaId;

    /**
     * Area name.
     *
     * @var string
     */
    protected string $areaName;

    /**
     * How likely the event is to occur.
     *
     * @var \Rugaard\WeatherKit\Enums\Certainty
     */
    protected Certainty $certainty;

    /**
     * Country code of alert.
     *
     * @var string
     */
    protected string $countryCode;

    /**
     * Human-readable description of event.
     *
     * @var string
     */
    protected string $description;

    /**
     * Alert time period.
     *
     * @var \Rugaard\WeatherKit\DTO\TimePeriod
     */
    protected TimePeriod $alertPeriod;

    /**
     * Underlying event time period.
     *
     * @var \Rugaard\WeatherKit\DTO\TimePeriod|null
     */
    protected ?TimePeriod $eventPeriod;

    /**
     * URL to Apple's WeatherKit alert presentation.
     *
     * @var string|null
     */
    protected ?string $embedUrl;

    /**
     * Importance of alert.
     *
     * @var \Rugaard\WeatherKit\Enums\Importance|null
     */
    protected ?Importance $importance;

    /**
     * Time of when alert was issued by reporting agency.
     *
     * @var \DateTime
     */
    protected DateTime $issuedTime;

    /**
     * Alert precedence.
     *
     * @var bool
     */
    protected bool $precedence;

    /**
     * Recommended actions.
     *
     * @var \Illuminate\Support\Collection
     */
    protected Collection $recommendedActions;

    /**
     * Level of danger to life and property.
     *
     * @var \Rugaard\WeatherKit\Enums\Severity
     */
    protected Severity $severity;

    /**
     * Source of alert.
     *
     * @var \Rugaard\WeatherKit\DTO\Source|null
     */
    protected ?Source $source;

    /**
     * Indication of urgency of action.
     *
     * @var \Rugaard\WeatherKit\Enums\Urgency|null
     */
    protected ?Urgency $urgency;

    /**
     * AbstractDTO constructor.
     *
     * @param array $data
     * @param \DateTimeZone $timezone
     */
    public function __construct(array $data, DateTimeZone $timezone)
    {
        $this->timezone = $timezone;
        parent::__construct($data);
    }

    /**
     * Parse data.
     *
     * @param array $data
     * @return void
     * @throws \Exception
     */
    protected function parse(array $data): void
    {
        $this->setAlertPeriod($data['effectiveTime'], $data['expireTime'])
             ->setAreaId($data['areaId'] ?? null)
             ->setAreaName($data['areaName'] ?? null)
             ->setCertainty($data['certainty'] ?? null)
             ->setCountryCode($data['countryCode'])
             ->setDescription($data['description'])
             ->setEmbedUrl($data['detailsUrl'] ?? null)
             ->setEventPeriod($data['eventOnsetTime'] ?? null, $data['eventEndTime'] ?? null)
             ->setId($data['id'])
             ->setImportance($data['importance'] ?? null)
             ->setIssuedTime($data['issuedTime'])
             ->setPrecedence((bool) ($data['precedence'] ?? false))
             ->setRecommendedActions($data['responses'] ?? [])
             ->setSeverity($data['severity'])
             ->setSource($data['source'] ?? null, $data['eventSource'] ?? null)
             ->setUrgency($data['urgency'] ?? null);
    }

    /**
     * Set area ID.
     *
     * @param string|null $areaId
     * @return $this
     */
    public function setAreaId(?string $areaId): self
    {
        $this->areaId = $areaId;
        return $this;
    }

    /**
     * Get area ID.
     *
     * @return string|null
     */
    public function getAreaId(): ?string
    {
        return $this->areaId;
    }

    /**
     * Set area name.
     *
     * @param string|null $areaId
     * @return $this
     */
    public function setAreaName(?string $areaId): self
    {
        $this->areaName = $areaId;
        return $this;
    }

    /**
     * Get area name.
     *
     * @return string|null
     */
    public function getAreaName(): ?string
    {
        return $this->areaName;
    }

    /**
     * Set alert time period.
     *
     * @param string $start
     * @param string $end
     * @return $this
     */
    public function setAlertPeriod(string $start, string $end): self
    {
        $this->alertPeriod = new TimePeriod(['start' => $start, 'end' => $end], $this->timezone);
        return $this;
    }

    /**
     * Get alert period.
     *
     * @return \Rugaard\WeatherKit\DTO\TimePeriod
     */
    public function getAlertPeriod(): TimePeriod
    {
        return $this->alertPeriod;
    }

    /**
     * Set certainty of alert.
     *
     * @param string $certainty
     * @return $this
     */
    public function setCertainty(string $certainty): self
    {
        $this->certainty = Certainty::tryFrom($certainty);
        return $this;
    }

    /**
     * Get certainty of alert.
     *
     * @return \Rugaard\WeatherKit\Enums\Certainty
     */
    public function getCertainty(): Certainty
    {
        return  $this->certainty;
    }

    /**
     * Set country code of reporting country.
     *
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * Get country code of reporting country.
     *
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * Set human-readable description of the event.
     *
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get human-readable description of the event.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set underlying weather event period.
     *
     * @param string|null $start
     * @param string|null $end
     * @return $this
     */
    public function setEventPeriod(?string $start, ?string $end): self
    {
        $this->eventPeriod = $start !== null || $end !== null ? new TimePeriod(['start' => $start, 'end' => $end], $this->timezone) : null;
        return $this;
    }

    /**
     * Get underlying weather event period.
     *
     * @return \Rugaard\WeatherKit\DTO\TimePeriod
     */
    public function getEventPeriod(): TimePeriod
    {
        return $this->eventPeriod;
    }

    /**
     * Set URL to Apple's WeatherKit alert presentation.
     *
     * @param string|null $url
     * @return $this
     */
    public function setEmbedUrl(?string $url): self
    {
        $this->embedUrl = $url;
        return $this;
    }

    /**
     * Get URL to Apple's WeatherKit alert presentation.
     *
     * @return string|null
     */
    public function getEmbedUrl(): ?string
    {
        return $this->embedUrl;
    }

    /**
     * Set alert ID.
     *
     * @param string $id
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get alert ID.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set importance of alert.
     *
     * @param string|null $importance
     * @return $this
     */
    public function setImportance(?string $importance): self
    {
        $this->importance = Importance::tryFrom($importance);
        return $this;
    }

    /**
     * Get importance of alert.
     *
     * @return \Rugaard\WeatherKit\Enums\Importance|null
     */
    public function getImportance(): ?Importance
    {
        return $this->importance;
    }

    /**
     * Set time that event was issued by the reporting agency.
     *
     * @param string $issuedTime
     * @return $this
     * @throws \Exception
     */
    public function setIssuedTime(string $issuedTime): self
    {
        $this->issuedTime = (new DateTime($issuedTime))->setTimezone($this->timezone);
        return $this;
    }

    /**
     * Get time that event was issued by the reporting agency.
     *
     * @return \DateTime
     */
    public function getIssuedTime(): DateTime
    {
        return $this->issuedTime;
    }

    /**
     * Set alert precedent.
     *
     * @param bool $precedence
     * @return $this
     * @throws \Exception
     */
    public function setPrecedence(bool $precedence): self
    {
        $this->precedence = $precedence;
        return $this;
    }

    /**
     * Get alert precedent.
     *
     * @return bool
     */
    public function getPrecedence(): bool
    {
        return $this->precedence;
    }

    /**
     * Set recommended actions.
     *
     * @param array $recommendedActions
     * @return $this
     */
    public function setRecommendedActions(array $recommendedActions = []): self
    {
        $this->recommendedActions = Collection::make($recommendedActions)->map(fn ($action) => Action::tryFrom($action))->reject(fn ($action) => $action === null);
        return $this;
    }

    /**
     * Get recommended actions.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getRecommendedActions(): Collection
    {
        return $this->recommendedActions;
    }

    /**
     * Set severity of alert.
     *
     * @param string $severity
     * @return $this
     */
    public function setSeverity(string $severity): self
    {
        $this->severity = Severity::tryFrom($severity);
        return $this;
    }

    /**
     * Get severity of alert.
     *
     * @return \Rugaard\WeatherKit\Enums\Severity
     */
    public function getSeverity(): Severity
    {
        return  $this->severity;
    }

    /**
     * Set source of alert.
     *
     * @param string|null $source
     * @param string|null $service
     * @return $this
     */
    public function setSource(?string $source, ?string $service): self
    {
        $this->source = $source !== null || $service !== null ? new Source(['name' => $source, 'service' => $service]) : null;
        return $this;
    }

    /**
     * Get source of alert.
     *
     * @return \Rugaard\WeatherKit\DTO\Source|null
     */
    public function getSource(): ?Source
    {
        return $this->source;
    }

    /**
     * Set urgency of alert.
     *
     * @param string $urgency
     * @return $this
     */
    public function setUrgency(string $urgency): self
    {
        $this->urgency = Urgency::tryFrom($urgency);
        return $this;
    }

    /**
     * Get urgency of alert.
     *
     * @return \Rugaard\WeatherKit\Enums\Urgency
     */
    public function getUrgency(): Urgency
    {
        return  $this->urgency;
    }
}
