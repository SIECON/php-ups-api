<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\SerializableEntity;

class TaxInformation extends SerializableEntity
{

    /**
     * @var VatTaxID
     */
    private $VatTaxID;

    /**
     * Set the value of VatTaxID
     *
     * @param  VatTaxID  $VatTaxID
     *
     * @return  self
     */
    public function setVatTaxID(VatTaxID $VatTaxID)
    {
        $this->VatTaxID = $VatTaxID;

        return $this;
    }
}
