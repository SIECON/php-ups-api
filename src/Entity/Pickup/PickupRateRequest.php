<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\SerializableEntity;

class PickupRateRequest extends SerializableEntity
{
    const SAME_DAY_PICKUP = '01';
    const FUTURE_DAY_PICKUP = '02';
    const SPECIFIC_DAY_PICKUP = '03';
    /**
     * Shipper account information.
     * @var PickupShipper
     */
    private $Shipper;

    /**
     * The address to pick up the packages
     * @var PickupAddress
     */
    private $PickupAddress;

    /**
     * Indicates if the pickup address is a different address than that specified in customer's profile.
     * Valid values:
     * Y = Alternate address
     * N = Original pickup address (default)
     * @var string
     */
    private $AlternateAddressIndicator;

    /**
     * Indicates the pickup timeframe. 
     * If 03 is selected, then PickupDate, EarliestReadyTime, and LatestClosetime must be specified.
     */
    private $ServiceDateOption;

    /**
     * Required if the ServiceDateOption is: 03 A Specific-Day Pickup.
     * @var PickupDateInfo
     */
    private $PickupDateInfo;

    /**
     * Indicates whether to return detailed taxes for oncall pickups. Valid values:
     * Y = Rate this pickup with taxes
     * N = Do not rate this pickup with taxes (default)
     * @var string
     */
    private $TaxInformationIndicator;

    /**
     * Indicates whether to return user level promo discount for the on-callpickups.
     * Valid values:
     * Y = Rate this pickup with user level promo discount
     * N = Do not rate this pickup with user level promo discount (default).
     * @var string
     */
    private $UserLevelDiscountIndicator;
    
    /**
     * Set shipper account information.
     *
     * @param  PickupShipper  $Shipper  Shipper account information.
     *
     * @return  self
     */
    public function setShipper(PickupShipper $Shipper)
    {
        $this->Shipper = $Shipper;

        return $this;
    }

    /**
     * Set the address to pick up the packages
     *
     * @param  PickupAddress  $PickupAddress  The address to pick up the packages
     *
     * @return  self
     */
    public function setPickupAddress(PickupAddress $PickupAddress)
    {
        $this->PickupAddress = $PickupAddress;

        return $this;
    }

    /**
     * Set n = Original pickup address (default)
     *
     * @param  string  $AlternateAddressIndicator  N = Original pickup address (default)
     *
     * @return  self
     */
    public function setAlternateAddressIndicator(string $AlternateAddressIndicator)
    {
        $this->AlternateAddressIndicator = $AlternateAddressIndicator;

        return $this;
    }

    /**
     * Set indicates the pickup timeframe.
     *
     * @return  self
     */
    public function setServiceDateOption($ServiceDateOption)
    {
        $this->ServiceDateOption = $ServiceDateOption;

        return $this;
    }

    /**
     * Set required if the ServiceDateOption is: 03 A Specific-Day Pickup.
     *
     * @param  PickupDateInfo  $PickupDateInfo  Required if the ServiceDateOption is: 03 A Specific-Day Pickup.
     *
     * @return  self
     */
    public function setPickupDateInfo(PickupDateInfo $PickupDateInfo)
    {
        $this->PickupDateInfo = $PickupDateInfo;

        return $this;
    }

    /**
     * Set n = Do not rate this pickup with taxes (default)
     *
     * @param  string  $TaxInformationIndicator  N = Do not rate this pickup with taxes (default)
     *
     * @return  self
     */ 
    public function setTaxInformationIndicator(string $TaxInformationIndicator)
    {
        $this->TaxInformationIndicator = $TaxInformationIndicator;

        return $this;
    }

    /**
     * Set n = Do not rate this pickup with user level promo discount (default).
     *
     * @param  string  $UserLevelDiscountIndicator  N = Do not rate this pickup with user level promo discount (default).
     *
     * @return  self
     */ 
    public function setUserLevelDiscountIndicator(string $UserLevelDiscountIndicator)
    {
        $this->UserLevelDiscountIndicator = $UserLevelDiscountIndicator;

        return $this;
    }
}
