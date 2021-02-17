<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\SerializableEntity;

class PickupPendingStatusRequest extends SerializableEntity
{

    /**
     * Specify the type of pending pickup. Valid values: 
     * - oncall
     * - smart
     * - both
     * @var string
     */
    private $PickupType;

    /**
     * The specific account number belongs to the shipper
     * @var string
     */
    private $AccountNumber;

    /**
     * Set - both
     *
     * @param  string  $PickupType  - both
     *
     * @return  self
     */ 
    public function setPickupType(string $PickupType)
    {
        $this->PickupType = $PickupType;

        return $this;
    }

    /**
     * Set the specific account number belongs to the shipper
     *
     * @param  string  $AccountNumber  The specific account number belongs to the shipper
     *
     * @return  self
     */ 
    public function setAccountNumber(string $AccountNumber)
    {
        $this->AccountNumber = $AccountNumber;

        return $this;
    }

    /**
     * Get - both
     *
     * @return  string
     */ 
    public function getPickupType()
    {
        return $this->PickupType;
    }

    /**
     * Get the specific account number belongs to the shipper
     *
     * @return  string
     */ 
    public function getAccountNumber()
    {
        return $this->AccountNumber;
    }
}
