<?php

namespace Ups\Entity\Pickup;

use Ups\Entity\SerializableEntity;

class FreightOptionsAddress extends SerializableEntity
{
    /**
     * The city of pickup address if available.
     * It is required for non-postal country Ireland (IE).
     * @var string
     */
    private $City;

    /**
     * 1. It means district code for Hong Kong SAR, China (HK) 
     * 2. It means county for Ireland (IE)
     * 3. It means state or province for all the postal countries or territories.
     * It is required for non-postal countries or territories including HK and IE.
     * @var string
     */
    private $StateProvince;

    /**
     * Postal Code for postal countries or territories.
     * It does not apply to non-postal countries or territories such as IE and HK
     * @var string
     */
    private $PostalCode;

    /**
     * The pickup country or territory code as defined by ISO-3166. Refer to Country or Territory Codes in the Appendix for valid values.
     * Upper-case two-letter string.
     * @var string
     */
    private $CountryCode;
}
