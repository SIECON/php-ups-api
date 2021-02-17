<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\Dimensions;
use Ups\Entity\SerializableEntity;

class PalletInformation extends SerializableEntity
{
    /**
     * Dimensions of largest pallet
     * @var Dimensions
     */
    private $Dimensions;
}
