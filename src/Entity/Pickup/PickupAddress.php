<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\Phone;
use Ups\Entity\SerializableEntity;

class PickupAddress extends SerializableEntity
{
    /**
     * Company name
     * @var string
     */
    private $CompanyName;

    /**
     * Name of contact person
     * @var string
     */
    private $ContactName;

    /**
     * Detailed street address. For Jan. 2010 release, only one AddressLine is allowed
     * @var string
     */
    private $AddressLine;

    /**
     * Room number
     * @var string
     */
    private $Room;

    /**
     * Floor number
     * @var string
     */
    private $Floor;

    /**
     * City or equivalent
     * @var string
     */
    private $City;

    /**
     * State or province for postal countries or territories; county for Ireland (IE) and district code for Hong Kong SAR, China (HK)
     * @var string
     */
    private $StateProvince;

    /**
     * Barrio for Mexico (MX) 
     * Urbanization for Puerto Rico (PR) 
     * Shire for United Kingdom (UK)
     * @var string
     */
    private $Urbanization;

    /**
     * Postal code or equivalent for postal countries or territories.
     * @var string
     */
    private $PostalCode;

    /**
     * The pickup country or territory code as defined by ISO-3166. Refer to Country or Territory Codes in the Appendix for valid values
     * @var string
     */
    private $CountryCode;

    /**
     * Indicates if the pickup address is commercial or residential. Valid values:
     * Y = Residential address
     * N = Non-residential (Commercial) address (default)
     * @var string
     */
    private $ResidentialIndicator;

    /**
     * The specific spot to pickup at the address.
     * @var string
     */
    private $PickupPoint;

    /**
     * @var Phone
     */
    private $Phone;

    /**
     * Set company name
     *
     * @param  string  $CompanyName  Company name
     *
     * @return  self
     */
    public function setCompanyName(string $CompanyName)
    {
        if (
            $CompanyName !== null &&
            (strlen($CompanyName) > 27)
        ) {
            throw new \Exception("CompanyName must have maximum length 27");
        }
        $this->CompanyName = $CompanyName;

        return $this;
    }

    /**
     * Set name of contact person
     *
     * @param  string  $ContactName  Name of contact person
     *
     * @return  self
     */
    public function setContactName(string $ContactName)
    {
        if (
            $ContactName !== null &&
            (strlen($ContactName) > 22)
        ) {
            throw new \Exception("ContactName must have maximum length 22");
        }
        $this->ContactName = $ContactName;

        return $this;
    }

    /**
     * Set detailed street address. For Jan. 2010 release, only one AddressLine is allowed
     *
     * @param  string  $AddressLine  Detailed street address. For Jan. 2010 release, only one AddressLine is allowed
     *
     * @return  self
     */
    public function setAddressLine(string $AddressLine)
    {
        if (
            $AddressLine !== null &&
            (strlen($AddressLine) > 73)
        ) {
            throw new \Exception("AddressLine must have maximum length 73");
        }
        $this->AddressLine = $AddressLine;

        return $this;
    }

    /**
     * Set room number
     *
     * @param  string  $Room  Room number
     *
     * @return  self
     */
    public function setRoom(string $Room)
    {
        if (
            $Room !== null &&
            (strlen($Room) > 8)
        ) {
            throw new \Exception("Room must have maximum length 8");
        }
        $this->Room = $Room;

        return $this;
    }

    /**
     * Set floor number
     *
     * @param  string  $Floor  Floor number
     *
     * @return  self
     */
    public function setFloor(string $Floor)
    {
        if (
            $Floor !== null &&
            (strlen($Floor) > 3)
        ) {
            throw new \Exception("Floor must have maximum length 3");
        }
        $this->Floor = $Floor;

        return $this;
    }

    /**
     * Set city or equivalent
     *
     * @param  string  $City  City or equivalent
     *
     * @return  self
     */
    public function setCity(string $City)
    {
        if (
            $City !== null &&
            (strlen($City) > 50)
        ) {
            throw new \Exception("City must have maximum length 50");
        }
        $this->City = $City;

        return $this;
    }

    /**
     * Set state or province for postal countries or territories; county for Ireland (IE) and district code for Hong Kong SAR, China (HK)
     *
     * @param  string  $StateProvince  State or province for postal countries or territories; county for Ireland (IE) and district code for Hong Kong SAR, China (HK)
     *
     * @return  self
     */
    public function setStateProvince(string $StateProvince)
    {
        if (
            $StateProvince !== null &&
            (strlen($StateProvince) > 50)
        ) {
            throw new \Exception("StateProvince must have maximum length 50");
        }
        $this->StateProvince = $StateProvince;

        return $this;
    }

    /**
     * Set shire for United Kingdom (UK)
     *
     * @param  string  $Urbanization  Shire for United Kingdom (UK)
     *
     * @return  self
     */
    public function setUrbanization(string $Urbanization)
    {
        if (
            $Urbanization !== null &&
            (strlen($Urbanization) > 50)
        ) {
            throw new \Exception("Urbanization must have maximum length 50");
        }
        $this->Urbanization = $Urbanization;

        return $this;
    }

    /**
     * Set postal code or equivalent for postal countries or territories.
     *
     * @param  string  $PostalCode  Postal code or equivalent for postal countries or territories.
     *
     * @return  self
     */
    public function setPostalCode(string $PostalCode)
    {
        if (
            $PostalCode !== null &&
            (strlen($PostalCode) > 8)
        ) {
            throw new \Exception("PostalCode must have maximum length 8");
        }
        $this->PostalCode = $PostalCode;

        return $this;
    }

    /**
     * Set the pickup country or territory code as defined by ISO-3166. Refer to Country or Territory Codes in the Appendix for valid values
     *
     * @param  string  $CountryCode  The pickup country or territory code as defined by ISO-3166. Refer to Country or Territory Codes in the Appendix for valid values
     *
     * @return  self
     */
    public function setCountryCode(string $CountryCode)
    {
        if (
            $CountryCode !== null &&
            (strlen($CountryCode) !== 2)
        ) {
            throw new \Exception("CountryCode must have length 2");
        }
        $this->CountryCode = $CountryCode;

        return $this;
    }

    /**
     * Set n = Non-residential (Commercial) address (default)
     *
     * @param  string  $ResidentialIndicator  N = Non-residential (Commercial) address (default)
     *
     * @return  self
     */
    public function setResidentialIndicator(string $ResidentialIndicator)
    {
        if (
            $ResidentialIndicator !== null &&
            (strlen($ResidentialIndicator) !== 1)
        ) {
            throw new \Exception("ResidentialIndicator must have length 1");
        }
        $this->ResidentialIndicator = $ResidentialIndicator;

        return $this;
    }

    /**
     * Set the specific spot to pickup at the address.
     *
     * @param  string  $PickupPoint  The specific spot to pickup at the address.
     *
     * @return  self
     */
    public function setPickupPoint(string $PickupPoint)
    {
        if (
            $PickupPoint !== null &&
            (strlen($PickupPoint) > 11)
        ) {
            throw new \Exception("PickupPoint must have maximum length 11");
        }
        $this->PickupPoint = $PickupPoint;

        return $this;
    }

    /**
     * Set the value of Phone
     *
     * @param  Phone  $Phone
     *
     * @return  self
     */
    public function setPhone(Phone $Phone)
    {
        $this->Phone = $Phone;

        return $this;
    }
}
