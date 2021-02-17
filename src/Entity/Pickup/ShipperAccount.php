<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\SerializableEntity;

class ShipperAccount extends SerializableEntity
{
    /**
     * UPS account number
     * @var string
     */
    private $AccountNumber;

    /**
     * Country or Territory code as defined by ISO-3166.
     * Refer to Country or Territory Codes in the Appendix for valid values.
     * @var string
     */
    private $AccountCountryCode;

    public function __construct($AccountNumber = null, $AccountCountryCode = null)
    {
        $this->AccountNumber = $AccountNumber;
        $this->AccountCountryCode = $AccountCountryCode;
    }

    /**
     * Set UPS account number
     *
     * @param  string  $AccountNumber  UPS account number
     *
     * @return  self
     */
    public function setAccountNumber(string $AccountNumber)
    {
        if (
            $AccountNumber !== null &&
            (strlen($AccountNumber) !== 6 && strlen($AccountNumber) !== 10)
        ) {
            throw new \Exception("Account number must have length 6 or 10");
        }
        $this->AccountNumber = $AccountNumber;

        return $this;
    }

    /**
     * Set refer to Country or Territory Codes in the Appendix for valid values.
     *
     * @param  string  $AccountCountryCode  Refer to Country or Territory Codes in the Appendix for valid values.
     *
     * @return  self
     */
    public function setAccountCountryCode(string $AccountCountryCode)
    {
        if (
            $AccountCountryCode !== null &&
            (strlen($AccountCountryCode) !== 2)
        ) {
            throw new \Exception("Account Country Code must have length 2");
        }
        $this->AccountCountryCode = $AccountCountryCode;

        return $this;
    }
}
