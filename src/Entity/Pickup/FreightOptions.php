<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\Pickup\FreightOptionsAddress;
use Ups\Entity\SerializableEntity;

class FreightOptions extends SerializableEntity
{
    /**
     * Supports various optional indicators
     * @var PickupShipmentServiceOptions
     */
    private $ShipmentServiceOptions;

    /**
     * Origin SLIC. This will be obtained from submitting a pickup service center request. See PickupGetFacilitiesServiceCenterRequest
     * @var string
     */
    private $OriginServiceCenterCode;

    /**
     * Country or territory of Service Center SLIC chosen to drop off.
     * @var string
     */
    private $OriginServiceCountryCode;

    /**
     * Destination Address Container.
     * @var FreightOptionsAddress
     */
    private $DestinationAddress;

    /**
     * Refers to the ShipmentDetail Container under Freight Options
     * @var ShipmentDetail
     */
    private $ShipmentDetail;
}
