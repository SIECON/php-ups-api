<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\SerializableEntity;

class VatTaxID extends SerializableEntity
{
    const VAT_TAX_ID = '01';
    const PERSONAL_FISCAL_CODE = '02';

    /**
     * Tax ID Type. If TaxIDType is not provided or is invalid, the default value will be used.
     * Valid values:
     * 01 - Vat Tax ID (default)
     * 02 - Personal Fiscal Code
     * 
     * @var string
     */
    private $TaxIDType;

    /**
     * Posta Elettronica Certificata (PEC) which is the recipient code for the customers certified electronic mail value.
     * Valid format includes ‘@’ and ‘.’ ex. xxxxx@xxxx.xxx
     * 
     * @var string
     */
    private $CertifiedElectronicMail;

    /**
     * Sistema Di Interscambio(SDI) which is the recipient code for the customer's interchange value or Interchange System Code.
     *
     * @var string
     */
    private $InterchangeSystemCode;

    /**
     * Set 02 - Personal Fiscal Code
     *
     * @param  string  $TaxIDType  02 - Personal Fiscal Code
     *
     * @return  self
     */
    public function setTaxIDType(string $TaxIDType)
    {
        $allowed_tax_id_types = [self::VAT_TAX_ID, self::PERSONAL_FISCAL_CODE];
        if (
            $TaxIDType !== null &&
            (!in_array($TaxIDType, $allowed_tax_id_types))
        ) {
            throw new \Exception("TaxIDType must be one of: " . implode(',', $allowed_tax_id_types));
        }

        $this->TaxIDType = $TaxIDType;

        return $this;
    }

    /**
     * Set valid format includes ‘@’ and ‘.’ ex. xxxxx@xxxx.xxx
     *
     * @param  string  $CertifiedElectronicMail  Valid format includes ‘@’ and ‘.’ ex. xxxxx@xxxx.xxx
     *
     * @return  self
     */
    public function setCertifiedElectronicMail(string $CertifiedElectronicMail)
    {
        if (
            $CertifiedElectronicMail !== null &&
            (strlen($CertifiedElectronicMail) > 30)
        ) {
            throw new \Exception("CertifiedElectronicMail must have maximum length of 30");
        }
        $this->CertifiedElectronicMail = $CertifiedElectronicMail;

        return $this;
    }

    /**
     * Set sistema Di Interscambio(SDI) which is the recipient code for the customer's interchange value or Interchange System Code.
     *
     * @param  string  $InterchangeSystemCode  Sistema Di Interscambio(SDI) which is the recipient code for the customer's interchange value or Interchange System Code.
     *
     * @return  self
     */
    public function setInterchangeSystemCode(string $InterchangeSystemCode)
    {
        if (
            $InterchangeSystemCode !== null &&
            (strlen($InterchangeSystemCode) > 15)
        ) {
            throw new \Exception("InterchangeSystemCode must have maximum length of 15");
        }
        $this->InterchangeSystemCode = $InterchangeSystemCode;

        return $this;
    }
}
