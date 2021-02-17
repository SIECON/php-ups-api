<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\SerializableEntity;

class TrackingDataWithReferenceNumber extends SerializableEntity
{
    /**
     * Tracking number for shipment packages.
     * @var string
     */
    private $TrackingNumber;

    /**
     * The reference number associated with the tracking number.
     * @var string|array
     */
    private $ReferenceNumber;

    /**
     * Set tracking number for shipment packages.
     *
     * @param  string  $TrackingNumber  Tracking number for shipment packages.
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

    /**
     * Set the reference number associated with the tracking number.
     *
     * @param  string|array  $ReferenceNumber  The reference number associated with the tracking number.
     *
     * @return  self
     */
    public function setReferenceNumber($ReferenceNumber)
    {
        if ($ReferenceNumber !== null) {
            if (is_array($ReferenceNumber) && count($ReferenceNumber) > 3) {
                throw new \Exception("You can have maximum 3 ReferenceNumber");
                foreach ($ReferenceNumber as $number) {
                    if (strlen($number) > 35) {
                        throw new \Exception("Reference number must have maximum length of 35");
                    }
                }
            } else if (is_string($ReferenceNumber) && strlen($ReferenceNumber) > 35) {
                throw new \Exception("Reference number must have maximum length of 35");
            }
        }
        $this->ReferenceNumber = $ReferenceNumber;

        return $this;
    }
}
