<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\SerializableEntity;

class Weight extends SerializableEntity
{
    /**
     * The weight of the package
     * One decimal digit is allowed. Example: 10.9
     * @var string
     */
    private $Weight;

    /**
     * The code representing the unit of measurement associated with the package.
     * LBS = Pounds
     * KGS = Kilograms
     * @var string
     */
    private $UnitOfMeasurement;
}
