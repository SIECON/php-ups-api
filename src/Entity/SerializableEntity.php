<?php

namespace Ups\Entity;

use JsonSerializable;

abstract class SerializableEntity implements JsonSerializable
{
    public function jsonSerialize()
    {
        $reflection = new \ReflectionClass($this);
        $properties = [];
        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            $properties[ucfirst($property->getName())] = $property->getValue($this);
        }
        if ($reflection->getParentClass()) {
            foreach ($reflection->getParentClass()->getProperties() as $property) {
                $property->setAccessible(true);
                $properties[ucfirst($property->getName())] = $property->getValue($this);
            }
        }

        // return non-null values
        return array_filter($properties);
    }
}
