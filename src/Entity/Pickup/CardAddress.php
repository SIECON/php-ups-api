<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\SerializableEntity;

class CardAddress extends SerializableEntity
{
    /**
     * Address Lines of the credit card billing address.
     * Max of three address lines can be provided.
     * @var array
     */
    private $AddressLine;

    /**
     * Charge card billing city
     * @var string
     */
    private $City;

    /**
     * Charge card billing State province code
     * @var string
     */
    private $StateProvince;

    /**
     * Charge card billing address postal code.
     * This is a required field for postal countries or territories.
     * @var string
     */
    private $PostalCode;

    /**
     * Charge card billing address country or territory code defined by ISO-3166..
     * Upper-case two letter string. For Discover card it should be US.
     * @var string
     */
    private $CountryCode;

    /**
     * Set max of three address lines can be provided.
     *
     * @param  string|array  $AddressLine  Max of three address lines can be provided.
     *
     * @return  self
     */
    public function setAddressLine($AddressLine)
    {
        if ($AddressLine !== null) {
            if (is_array($AddressLine) && count($AddressLine) > 3) {
                throw new \Exception("You can have maximum 3 Address Lines");
                foreach ($AddressLine as $address) {
                    if (strlen($address) > 35) {
                        throw new \Exception("Address Lines must have maximum length of 35");
                    }
                }
            } else if (is_string($AddressLine) && strlen($AddressLine) > 35) {
                throw new \Exception("Address Lines must have maximum length of 35");
            }
        }

        $this->AddressLine = $AddressLine;

        return $this;
    }

    /**
     * Set charge card billing city
     *
     * @param  string  $City  Charge card billing city
     *
     * @return  self
     */
    public function setCity(string $City)
    {
        if (
            $City !== null &&
            (strlen($City) > 50)
        ) {
            throw new \Exception("City must have maximum length of 50");
        }
        $this->City = $City;

        return $this;
    }

    /**
     * Set charge card billing State province code
     *
     * @param  string  $StateProvince  Charge card billing State province code
     *
     * @return  self
     */
    public function setStateProvince(string $StateProvince)
    {
        if (
            $StateProvince !== null &&
            (strlen($StateProvince) > 50)
        ) {
            throw new \Exception("State Province must have maximum length of 50");
        }
        $this->StateProvince = $StateProvince;

        return $this;
    }

    /**
     * Set this is a required field for postal countries or territories.
     *
     * @param  string  $PostalCode  This is a required field for postal countries or territories.
     *
     * @return  self
     */
    public function setPostalCode(string $PostalCode)
    {
        if (
            $PostalCode !== null &&
            (strlen($PostalCode) > 8)
        ) {
            throw new \Exception("Postal Code must have maximum length of 8");
        }

        $this->PostalCode = $PostalCode;

        return $this;
    }

    /**
     * Set upper-case two letter string. For Discover card it should be US.
     *
     * @param  string  $CountryCode  Upper-case two letter string. For Discover card it should be US.
     *
     * @return  self
     */
    public function setCountryCode(string $CountryCode)
    {
        if (
            $CountryCode !== null &&
            (strlen($CountryCode) !== 2)
        ) {
            throw new \Exception("Country Code Code must have length of 2");
        }
        $this->CountryCode = $CountryCode;

        return $this;
    }
}
