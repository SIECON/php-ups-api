<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\SerializableEntity;

class TrackingData extends SerializableEntity
{
    /**
     * Tracking number for return shipment or forward shipment packages.
     * @var string
     */
    private $TrackingNumber;

    /**
     * Set tracking number for return shipment or forward shipment packages.
     *
     * @param  string  $TrackingNumber  Tracking number for return shipment or forward shipment packages.
     *
     * @return  self
     */
    public function setTrackingNumber(string $TrackingNumber)
    {
        if ($TrackingNumber !== null && strlen($TrackingNumber) !== 18) {
            throw new \Exception("Tracking number must have length 18");
        }
        $this->TrackingNumber = $TrackingNumber;

        return $this;
    }
}
