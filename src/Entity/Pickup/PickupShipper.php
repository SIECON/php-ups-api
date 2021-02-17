<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\SerializableEntity;

class PickupShipper extends SerializableEntity
{
    /**
     * Shipper account information.
     * Must provide when choose to pay the pickup by shipper account number.
     * @var ShipperAccount
     */
    private $Account;

    /**
     * Container for Charge Card payment method.
     * Required if Payment method is 03. Credit/Charge card payment is valid for US, CA, PR and GB origin pickups.
     * @var ChargeCard
     */
    private $ChargeCard;

    public function __construct(ShipperAccount $Account = null, ChargeCard $ChargeCard = null)
    {
        $this->Account = $Account;
        $this->ChargeCard = $ChargeCard;
    }
    /**
     * Set must provide when choose to pay the pickup by shipper account number.
     *
     * @param  ShipperAccount  $Account  Must provide when choose to pay the pickup by shipper account number.
     *
     * @return  self
     */
    public function setAccount(ShipperAccount $Account)
    {
        $this->Account = $Account;

        return $this;
    }

    /**
     * Set required if Payment method is 03. Credit/Charge card payment is valid for US, CA, PR and GB origin pickups.
     *
     * @param  ChargeCard  $ChargeCard  Required if Payment method is 03. Credit/Charge card payment is valid for US, CA, PR and GB origin pickups.
     *
     * @return  self
     */
    public function setChargeCard(ChargeCard $ChargeCard)
    {
        $this->ChargeCard = $ChargeCard;

        return $this;
    }
}
