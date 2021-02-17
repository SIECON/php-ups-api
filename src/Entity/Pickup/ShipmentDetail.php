<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\SerializableEntity;

class ShipmentDetail extends SerializableEntity
{
    /**
     * Indicates hazardous materials
     * @var string
     */
    private $hazmatIndicator;

    /**
     * Pallet Details.
     * @var PalletInformation
     */
    private $palletInformation;
}
