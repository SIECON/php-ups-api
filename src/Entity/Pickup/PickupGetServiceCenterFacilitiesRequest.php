<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\SerializableEntity;

class PickupGetServiceCenterFacilitiesRequest extends SerializableEntity
{
    /**
     * Pickup Piece Container.
     * @var PickupPiece
     */
    private $PickupPiece;

    /**
     * Indicates the address of the shipper to allow for the nearest Drop off facility Search.
     * Conditionally required for drop off location search.
     * @var PickupOriginAddress
     */
    private $OriginAddress;

    /**
     * DestinationAddress container.
     * Conditionally required for pickup location search.
     * @var PickupAddress
     */
    private $DestinationAddress;

    /**
     * Origin Country or Territory Locale. 
     * Locale should be Origin Country or Territory. Example: en_US.
     * The Last 50 instruction will be send based on this locale. Locale is required if PoximityIndicator is present for Drop Off facilities.
     * @var string
     */
    private $Locale;

    /**
     * Proximity Indicator.
     * Indicates the user requested the proximity search for UPS Worldwide Express Freight and UPS Worldwide Express Freight Midday locations 
     * for the origin address and/or the airport code, and the sort code for destination address.
     * @var string
     */
    private $ProximitySearchIndicator;

    /**
     * Set pickup Piece Container.
     *
     * @param  PickupPiece  $PickupPiece  Pickup Piece Container.
     *
     * @return  self
     */ 
    public function setPickupPiece(PickupPiece $PickupPiece)
    {
        $this->PickupPiece = $PickupPiece;

        return $this;
    }

    /**
     * Set conditionally required for drop off location search.
     *
     * @param  PickupOriginAddress  $OriginAddress  Conditionally required for drop off location search.
     *
     * @return  self
     */ 
    public function setOriginAddress(PickupOriginAddress $OriginAddress)
    {
        $this->OriginAddress = $OriginAddress;

        return $this;
    }

    /**
     * Set conditionally required for pickup location search.
     *
     * @param  PickupAddress  $DestinationAddress  Conditionally required for pickup location search.
     *
     * @return  self
     */ 
    public function setDestinationAddress(PickupAddress $DestinationAddress)
    {
        $this->DestinationAddress = $DestinationAddress;

        return $this;
    }

    /**
     * Set the Last 50 instruction will be send based on this locale. Locale is required if PoximityIndicator is present for Drop Off facilities.
     *
     * @param  string  $Locale  The Last 50 instruction will be send based on this locale. Locale is required if PoximityIndicator is present for Drop Off facilities.
     *
     * @return  self
     */ 
    public function setLocale(string $Locale)
    {
        $this->Locale = $Locale;

        return $this;
    }

    /**
     * Set for the origin address and/or the airport code, and the sort code for destination address.
     *
     * @param  string  $ProximitySearchIndicator  for the origin address and/or the airport code, and the sort code for destination address.
     *
     * @return  self
     */ 
    public function setProximitySearchIndicator(string $ProximitySearchIndicator)
    {
        $this->ProximitySearchIndicator = $ProximitySearchIndicator;

        return $this;
    }
}
