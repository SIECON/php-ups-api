<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\SerializableEntity;

class ChargeCard extends SerializableEntity
{
    const AMERICAN_EXPRESS = '01';
    const DISCOVER = '03';
    const MASTERCARD = '04';
    const VISA = '06';

    /**
     * Charge card holder name. If the name is not provided, defaults to "No Name Provided".
     * @var string
     */
    private $CardHolderName;

    /**
     * Charge card type. Valid values: 
     * 01 = American Express
     * 03 = Discover
     * 04 = Mastercard
     * 06 = VISA
     * Discover card Pickup country US only.
     * @var string
     */
    private $CardType;

    /**
     * Charge card number.
     * For Privileged clients, this element must be tokenized card number.
     * @var string
     */
    private $CardNumber;

    /**
     * Credit card expiration date.
     * Format: yyyyMM
     * yyyy = 4 digit year, valid value current year - 10 years. MM = 2 digit month, valid values 01-12
     * @var string
     */
    private $ExpirationDate;

    /**
     * Three or four digits that can be found either on top of credit card number or on the back of credit card.
     * Number of digits varies for different type of credit card.
     * @var string
     */
    private $SecurityCode;

    /**
     * Container to hold the Charge card address.
     * @var CardAddress
     */
    private $CardAddress;

    /**
     * Set charge card holder name. If the name is not provided, defaults to "No Name Provided".
     *
     * @param  string  $CardHolderName  Charge card holder name. If the name is not provided, defaults to "No Name Provided".
     *
     * @return  self
     */
    public function setCardHolderName(string $CardHolderName)
    {
        if (
            $CardHolderName !== null &&
            (strlen($CardHolderName) > 22)
        ) {
            throw new \Exception("Card holder name must have maximum length of 22");
        }
        $this->CardHolderName = $CardHolderName;

        return $this;
    }

    /**
     * Set discover card Pickup country US only.
     *
     * @param  string  $CardType  Discover card Pickup country US only.
     *
     * @return  self
     */
    public function setCardType(string $CardType)
    {
        $allowed_card_types = [self::AMERICAN_EXPRESS, self::DISCOVER, self::MASTERCARD, self::VISA];
        if (
            $CardType !== null &&
            (!in_array($CardType, $allowed_card_types))
        ) {
            throw new \Exception("Card type must be one of: " . implode(',', $allowed_card_types));
        }
        $this->CardType = $CardType;

        return $this;
    }

    /**
     * Set for Privileged clients, this element must be tokenized card number.
     *
     * @param  string  $CardNumber  For Privileged clients, this element must be tokenized card number.
     *
     * @return  self
     */
    public function setCardNumber(string $CardNumber)
    {
        if (
            $CardNumber !== null &&
            (strlen($CardNumber) < 9  && strlen($CardNumber) > 16)
        ) {
            throw new \Exception("Card number name must have length between 9 and 16");
        }
        $this->CardNumber = $CardNumber;

        return $this;
    }

    /**
     * Set yyyy = 4 digit year, valid value current year - 10 years. MM = 2 digit month, valid values 01-12
     *
     * @param  string  $ExpirationDate  yyyy = 4 digit year, valid value current year - 10 years. MM = 2 digit month, valid values 01-12
     *
     * @return  self
     */
    public function setExpirationDate(string $ExpirationDate)
    {
        if (
            $ExpirationDate !== null &&
            (strlen($ExpirationDate) !== 6)
        ) {
            throw new \Exception("Expiration date must have length 6");
        }
        $this->ExpirationDate = $ExpirationDate;

        return $this;
    }

    /**
     * Set number of digits varies for different type of credit card.
     *
     * @param  string  $SecurityCode  Number of digits varies for different type of credit card.
     *
     * @return  self
     */
    public function setSecurityCode(string $SecurityCode)
    {
        if (
            $SecurityCode !== null &&
            (strlen($SecurityCode) !== 3 && strlen($SecurityCode) !== 4)
        ) {
            throw new \Exception("Security Code must have length 3 or 4");
        }
        $this->SecurityCode = $SecurityCode;

        return $this;
    }

    /**
     * Set container to hold the Charge card address.
     *
     * @param  CardAddress  $CardAddress  Container to hold the Charge card address.
     *
     * @return  self
     */
    public function setCardAddress(CardAddress $CardAddress)
    {
        $this->CardAddress = $CardAddress;

        return $this;
    }
}
