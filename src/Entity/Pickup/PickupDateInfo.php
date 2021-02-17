<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\SerializableEntity;

class PickupDateInfo extends SerializableEntity
{
    /**
     * Pickup location's local close time.
     * - User provided Close Time must be later than the Earliest Allowed Customer Close Time.
     * - Earliest Allowed Customer Close Time is defined by UPS pickup operation system.
     * - CloseTime minus ReadyTime must be greater than the LeadTime.
     * - LeadTime is determined by UPS pickup operation system. LeadTime is the minimum amount of time UPS requires between customer’s request for a pickup and driver arriving at the location for the pickup.
     * Format: HHmm
     * Hour: 0-23 Minute: 0-59
     * @var string
     */
    private $CloseTime;

    /**
     * Pickup location's local ready time.
     * ReadyTime means the time when your shipment(s) can be ready for UPS to pick up.
     * - User provided ReadyTime must be earlier than CallByTime.
     * - CallByTime is determined by UPS pickup operation system. CallByTime is the Latest time a Customer can call UPS or self- serve on UPS.com and complete a Pickup Request and UPS can still make the Pickup service request.
     * - If ReadyTime is earlier than current local time, UPS uses the current local time as the ReadyTime.
     * Format: HHmm
     * Hour: 0-23 Minute: 0-59
     * @var string     
     */
    private $ReadyTime;

    /**
     * Local pickup date of the location.
     * Format: yyyyMMdd yyyy = Year Applicable MM = 01– 12
     * dd = 01–31
     * @var string
     */
    private $PickupDate;

    public function __construct($CloseTime = null, $ReadyTime = null, $PickupDate = null)
    {
        $this->CloseTime = $CloseTime;
        $this->ReadyTime = $ReadyTime;
        $this->PickupDate = $PickupDate;
    }
    /**
     * Set hour: 0-23 Minute: 0-59
     *
     * @param  string  $CloseTime  Hour: 0-23 Minute: 0-59
     *
     * @return  self
     */
    public function setCloseTime(string $CloseTime)
    {
        if (
            $CloseTime !== null &&
            (strlen($CloseTime) !== 4)
        ) {
            throw new \Exception("CloseTime must have length 4");
        }
        $this->CloseTime = $CloseTime;

        return $this;
    }

    /**
     * Set hour: 0-23 Minute: 0-59
     *
     * @param  string  $ReadyTime  Hour: 0-23 Minute: 0-59
     *
     * @return  self
     */
    public function setReadyTime(string $ReadyTime)
    {
        if (
            $ReadyTime !== null &&
            (strlen($ReadyTime) !== 4)
        ) {
            throw new \Exception("ReadyTime must have length 4");
        }
        $this->ReadyTime = $ReadyTime;

        return $this;
    }

    /**
     * Set dd = 01–31
     *
     * @param  string  $PickupDate  dd = 01–31
     *
     * @return  self
     */
    public function setPickupDate(string $PickupDate)
    {
        if (
            $PickupDate !== null &&
            (strlen($PickupDate) !== 8)
        ) {
            throw new \Exception("PickupDate must have length 8");
        }
        $this->PickupDate = $PickupDate;

        return $this;
    }
}
