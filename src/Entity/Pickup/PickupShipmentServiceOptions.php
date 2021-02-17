<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\SerializableEntity;

class PickupShipmentServiceOptions extends SerializableEntity
{
    /**
     * Presence indicates OriginLiftGateRequiredIndicator is present.
     * Conditionally requirements. Must not be present if DropOffAtUPSFacilityIndicator is true
     * @var string
     */
    private $originLiftGateIndicator;

    /**
     * Identifies service center location information for Origin List of UPS Facilities.
     * @var string
     */
    private $dropoffAtUPSFacilityIndicator;

    /**
     * Identifies service center location information for Destination of UPS Facilities.
     * @var string
     */
    private $holdForPickupIndicator;
}
