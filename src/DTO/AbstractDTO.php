<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO;

use function get_object_vars;
use function method_exists;
use function ucfirst;

/**
 * AbstractDTO.
 *
 * @package Rugaard\WeatherKit\DTO
 */
abstract class AbstractDTO
{
    /**
     * AbstractDTO constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->parse(data: $data);
        }
    }

    /**
     * Parse data.
     *
     * @param  array $data
     * @return void
     */
    abstract protected function parse(array $data): void;

    /**
     * Return DTO as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        // Get all properties in class.
        $properties = get_object_vars(object: $this);

        // Container
        $container = [];

        // Loop through each value and look for the getter method.
        // If it doesn't exist, we'll ignore the variable.
        foreach ($properties as $propertyName => $propertyValue) {
            // Generate getter method name.
            $propertyMethod = 'get' . ucfirst(string: $propertyName);

            // Validate that getter method exists.
            if (!method_exists(object_or_class: $this, method: $propertyMethod)) {
                continue;
            }

            // Get value of variable.
            $value = $this->$propertyMethod();

            // Add value to container.
            $container[$propertyName] = ($value instanceof self) ? $value->toArray() : $value;
        }

        return $container;
    }
}
