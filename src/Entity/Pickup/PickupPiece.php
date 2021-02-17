<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\SerializableEntity;

class PickupPiece extends SerializableEntity
{
    const PACKAGE = '01';
    const UPS_LETTER = '02';
    const PALLET = '03';

    /**
     * Refer to Service Codes in the Appendix for valid values.
     * @var string
     */
    private $ServiceCode;

    /**
     * Number of pieces to be picked up
     * Max per service: 999
     * @var string
     */
    private $Quantity;

    /**
     * The destination country or territory code as defined by ISO-3166. Refer to Country or Territory Codes in the Appendix for valid values.
     * @var string
     */
    private $DestinationCountryCode;

    /**
     * Container type.
     * Valid values:
     * 01 = PACKAGE
     * 02 = UPS LETTER
     * 03 = PALLET
     * Note: 03 is used for only WWEF services
     * @var string
     */
    private $ContainerCode;

    /**
     * Set refer to Service Codes in the Appendix for valid values.
     *
     * @param  string  $ServiceCode  Refer to Service Codes in the Appendix for valid values.
     *
     * @return  self
     */
    public function setServiceCode(string $ServiceCode)
    {
        if ($ServiceCode !== null && strlen($ServiceCode) !== 3) {
            throw new \Exception("ServiceCode must have length 3");
        }
        $this->ServiceCode = $ServiceCode;

        return $this;
    }

    /**
     * Set max per service: 999
     *
     * @param  string  $Quantity  Max per service: 999
     *
     * @return  self
     */
    public function setQuantity(string $Quantity)
    {
        if ($Quantity !== null && strlen($Quantity) > 3) {
            throw new \Exception("Quantity must have maximum length 3");
        }
        $this->Quantity = $Quantity;

        return $this;
    }

    /**
     * Set the destination country or territory code as defined by ISO-3166. Refer to Country or Territory Codes in the Appendix for valid values.
     *
     * @param  string  $DestinationCountryCode  The destination country or territory code as defined by ISO-3166. Refer to Country or Territory Codes in the Appendix for valid values.
     *
     * @return  self
     */
    public function setDestinationCountryCode(string $DestinationCountryCode)
    {
        if ($DestinationCountryCode !== null && strlen($DestinationCountryCode) !== 2) {
            throw new \Exception("DestinationCountryCode must have length 2");
        }
        $this->DestinationCountryCode = $DestinationCountryCode;

        return $this;
    }

    /**
     * Set note: 03 is used for only WWEF services
     *
     * @param  string  $ContainerCode  Note: 03 is used for only WWEF services
     *
     * @return  self
     */
    public function setContainerCode(string $ContainerCode)
    {
        $allowed_codes = [self::PACKAGE, self::UPS_LETTER, self::PALLET];
        if ($ContainerCode !== null && !in_array($ContainerCode, $allowed_codes)) {
            throw new \Exception("ContainerCode must have be one of: " . implode(',', $allowed_codes));
        }
        $this->ContainerCode = $ContainerCode;

        return $this;
    }
}
