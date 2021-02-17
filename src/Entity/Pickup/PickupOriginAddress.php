<?php

namespace Ups\Entity\Pickup;

class PickupOriginAddress extends PickupAddress
{

    /**
     * Indicates the address of the shipper to allow for the nearest Drop off facility Search.
     * Conditionally required if proximitySearchIndicator is present.
     * @var string
     */
    private $StreetAddress;

    /**
     * Origin Search Criteria Container
     * Required if Proximity SearchIndicator is present.
     * @var SearchCriteria
     */
    private $OriginSearchCriteria;

    /**
     * Set conditionally required if proximitySearchIndicator is present.
     *
     * @param  string  $StreetAddress  Conditionally required if proximitySearchIndicator is present.
     *
     * @return  self
     */ 
    public function setStreetAddress(string $StreetAddress)
    {
        $this->StreetAddress = $StreetAddress;

        return $this;
    }

    /**
     * Set required if Proximity SearchIndicator is present.
     *
     * @param  SearchCriteria  $OriginSearchCriteria  Required if Proximity SearchIndicator is present.
     *
     * @return  self
     */ 
    public function setOriginSearchCriteria(SearchCriteria $OriginSearchCriteria)
    {
        $this->OriginSearchCriteria = $OriginSearchCriteria;

        return $this;
    }
}
