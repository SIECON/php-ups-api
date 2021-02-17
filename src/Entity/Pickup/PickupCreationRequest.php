<?php

namespace Ups\Entity\Pickup;

use Exception;
use Ups\Entity\Pickup\PickupAddress;
use Ups\Entity\Pickup\PickupDateInfo;
use Ups\Entity\Pickup\Weight;
use Ups\Entity\Pickup\TrackingData;
use Ups\Entity\Pickup\TrackingDataWithReferenceNumber;
use Ups\Entity\Pickup\FreightOptions;
use Ups\Entity\Pickup\PickupPiece;
use Ups\Entity\Pickup\PickupShipper;
use Ups\Entity\SerializableEntity;

class PickupCreationRequest extends SerializableEntity
{
    /**
     * Indicates whether to rate the on-call pickup or not. Valid values:
     * Y = Rate this pickup
     * N = Do not rate this pickup (default)
     * 
     * @var string
     */
    private $RatePickupIndicator;

    /**
     * 
     * Indicates whether to return detailed taxes for the on-call pickups. Valid values:
     * Y = Rate this pickup with taxes
     * N = Do not rate this pickup with taxes (default)
     * 
     * @var string
     */
    private $TaxInformationIndicator;

    /**
     * Indicates whether to return user level promo discount for the on- call pickups. Valid values:
     * Y = Rate this pickup with user level promo discount
     * N = Do not rate this pickup with user level promo discount(default)
     * 
     * @var string
     */
    private $UserLevelDiscountIndicator;

    /**
     * On-call pickup shipper or requestor information. Must provide when choose to pay the pickup by shipper account number.
     * It is optional if the shipper chooses any other payment method. However, it is highly recommended to provide if available.
     * @var PickupShipper
     */
    private $Shipper;

    /**
     * @var PickupDateInfo
     */
    private $PickupDateInfo;

    /**
     * @var PickupAddress
     */
    private $PickupAddress;

    /**
     * @var string
     */
    private $AlternateAddressIndicator;

    /**
     * The container providing the information about how many items should be picked up.
     * The total number of return and forwarding packages cannot exceed 9,999.
     * @var PickupPiece[]
     */
    private $PickupPiece;

    /**
     * Container for the total weight of all the items.
     * @var Weight
     */
    private $TotalWeight;

    /**
     * Indicates if at least any package is over 70 lbs or 32 kgs. Valid values:
     * Y = Over weight
     * N = Not over weight (default)
     * @var string
     */
    private $OverweightIndicator;

    /**
     * Container for Return Service and Forward Tracking Numbers. Accept no more than 30 TrackingData.
     * TrackingDataWithReferenceNumber and TrackingData container cannot be present at the same time.
     * @var TrackingData
     */
    private $TrackingData;

    /**
     * Container for Tracking Number with its associated reference numbers. 
     * This container should be populated to provide visibility into shipment tied to pickup being scheduled.
     * TrackingDataWithReferenceNumber and TrackingData container cannot be present at the same time.
     * @var TrackingDataWithReferenceNumber
     */
    private $TrackingDataWithReferenceNumber;

    /**
     * The payment method to pay for this on call pickup. 00 = No payment needed
     * 01 = Pay by shipper account
     * 03 = Pay by charge card
     * 04 = Pay by 1Z tracking number
     * 05 = Pay by check or money order
     * 06 = Cash(applicable only for these countries or territories - BE,FR,DE,IT,MX,NL,PL,ES,GB,CZ,HU,FI,NO)
     * 07 = Pay by PayPal
     * For countries or territories and (or) zip codes where pickup is free of charge, please submit 00, means no payment needed as payment method.
     * - If 01 is the payment method, then ShipperAccountNumber and ShipperAccount CountryCode must be provided.
     * - If 03 is selected, then CreditCard information should be provided.
     * - If 04 is selected, then the shipper agreed to pay for the pickup packages.
     * - If 05 is selected, then the shipper will pay for the pickup packages with a check or money order.
     * @var string
     */
    private $PaymentMethod;

    /**
     * Special handling instruction from the customer.
     * @var string
     */
    private $SpecialInstruction;

    /**
     * Information entered by a customer for Privileged reference.
     * @var string
     */
    private $ReferenceNumber;

    /**
     * Container will be used to indicate Service options, add optional Original service center, destination address and shipment details related to the UPS Worldwide Express Freight and UPS Worldwide Express Freight Midday.
     * @var FreightOptions
     */
    private $FreightOptions;

    /**
     * Service Category.
     * Applicable to the following countries or territories: BE, FR, DE, IT, MX, NL, PL, ES, GB
     * Valid values:
     * 01 - domestic (default)
     * 02 - international
     * 03 - transborder
     * 
     * @var string
     */
    private $ServiceCategory;

    /**
     * Describes the type of cash funds that the driver will collect. Applicable to the following countries or territories: BE,FR,DE,IT,MX,NL,PL,ES,GB,CZ,HU,FI,NO
     * Valid values:
     * 01 - Pickup only (default)
     * 02 - Transportation only
     * 03 - Pickup and Transportation
     * 03 - transborder
     * 
     * @var string
     */
    private $CashType;

    /**
     * This element should be set to “Y” in the request to indicate that user has pre-printed shipping labels for all the packages, otherwise this will be treated as false.
     * 
     * @var string
     */
    private $ShippingLabelsAvailable;

    /**
     * Set n = Do not rate this pickup (default)
     *
     * @param  string  $RatePickupIndicator  N = Do not rate this pickup (default)
     *
     * @return  self
     */
    public function setRatePickupIndicator(string $RatePickupIndicator)
    {
        $this->RatePickupIndicator = $RatePickupIndicator;

        return $this;
    }

    /**
     * Set n = Do not rate this pickup with taxes (default)
     *
     * @param  string  $TaxInformationIndicator  N = Do not rate this pickup with taxes (default)
     *
     * @return  self
     */
    public function setTaxInformationIndicator(string $TaxInformationIndicator)
    {
        $this->TaxInformationIndicator = $TaxInformationIndicator;

        return $this;
    }

    /**
     * Set n = Do not rate this pickup with user level promo discount(default)
     *
     * @param  string  $UserLevelDiscountIndicator  N = Do not rate this pickup with user level promo discount(default)
     *
     * @return  self
     */
    public function setUserLevelDiscountIndicator(string $UserLevelDiscountIndicator)
    {
        $this->UserLevelDiscountIndicator = $UserLevelDiscountIndicator;

        return $this;
    }

    /**
     * Set it is optional if the shipper chooses any other payment method. However, it is highly recommended to provide if available.
     *
     * @param  PickupShipper  $Shipper  It is optional if the shipper chooses any other payment method. However, it is highly recommended to provide if available.
     *
     * @return  self
     */
    public function setShipper(PickupShipper $Shipper)
    {
        $this->Shipper = $Shipper;

        return $this;
    }

    /**
     * Set the value of PickupDateInfo
     *
     * @param  PickupDateInfo  $PickupDateInfo
     *
     * @return  self
     */
    public function setPickupDateInfo(PickupDateInfo $PickupDateInfo)
    {
        $this->PickupDateInfo = $PickupDateInfo;

        return $this;
    }

    /**
     * Set the value of PickupAddress
     *
     * @param  PickupAddress  $PickupAddress
     *
     * @return  self
     */
    public function setPickupAddress(PickupAddress $PickupAddress)
    {
        $this->PickupAddress = $PickupAddress;

        return $this;
    }

    /**
     * Set the value of AlternateAddressIndicator
     *
     * @param  string  $AlternateAddressIndicator
     *
     * @return  self
     */
    public function setAlternateAddressIndicator(string $AlternateAddressIndicator)
    {
        if ($AlternateAddressIndicator !== null && !in_array($AlternateAddressIndicator, ['Y', 'N'])) {
            throw new \Exception('AlternateAddressIndicator must be Y or N');
        }
        $this->AlternateAddressIndicator = $AlternateAddressIndicator;

        return $this;
    }

    /**
     * Set the total number of return and forwarding packages cannot exceed 9,999.
     *
     * @param  PickupPiece[]  $PickupPiece  The total number of return and forwarding packages cannot exceed 9,999.
     *
     * @return  self
     */
    public function setPickupPiece(array $PickupPiece)
    {
        $this->PickupPiece = $PickupPiece;

        return $this;
    }

    /**
     * Set container for the total weight of all the items.
     *
     * @param  Weight  $TotalWeight  Container for the total weight of all the items.
     *
     * @return  self
     */
    public function setTotalWeight(Weight $TotalWeight)
    {
        $this->TotalWeight = $TotalWeight;

        return $this;
    }

    /**
     * Set n = Not over weight (default)
     *
     * @param  string  $OverweightIndicator  N = Not over weight (default)
     *
     * @return  self
     */
    public function setOverweightIndicator(string $OverweightIndicator)
    {
        $this->OverweightIndicator = $OverweightIndicator;

        return $this;
    }

    /**
     * Set trackingDataWithReferenceNumber and TrackingData container cannot be present at the same time.
     *
     * @param  TrackingData  $TrackingData  TrackingDataWithReferenceNumber and TrackingData container cannot be present at the same time.
     *
     * @return  self
     */
    public function setTrackingData(TrackingData $TrackingData)
    {
        $this->TrackingData = $TrackingData;

        return $this;
    }

    /**
     * Set trackingDataWithReferenceNumber and TrackingData container cannot be present at the same time.
     *
     * @param  TrackingDataWithReferenceNumber  $TrackingDataWithReferenceNumber  TrackingDataWithReferenceNumber and TrackingData container cannot be present at the same time.
     *
     * @return  self
     */
    public function setTrackingDataWithReferenceNumber(TrackingDataWithReferenceNumber $TrackingDataWithReferenceNumber)
    {
        $this->TrackingDataWithReferenceNumber = $TrackingDataWithReferenceNumber;

        return $this;
    }

    /**
     * Set - If 05 is selected, then the shipper will pay for the pickup packages with a check or money order.
     *
     * @param  string  $PaymentMethod  - If 05 is selected, then the shipper will pay for the pickup packages with a check or money order.
     *
     * @return  self
     */
    public function setPaymentMethod(string $PaymentMethod)
    {
        $allowed_methods = [
            PaymentMethod::TRACKING_NUMBER_1Z, PaymentMethod::SHIPPER_ACCOUNT, PaymentMethod::PAYPAL, PaymentMethod::CHECK_OR_MONEY_ORDER,
            PaymentMethod::CHARGE_CARD, PaymentMethod::CASH, PaymentMethod::NONE_REQUIRED
        ];
        if ($PaymentMethod !== null && !in_array($PaymentMethod, $allowed_methods)) {
            throw new \Exception("Payment method must be one of: " . implode(',', $allowed_methods));
        }
        $this->PaymentMethod = $PaymentMethod;

        return $this;
    }

    /**
     * Set special handling instruction from the customer.
     *
     * @param  string  $SpecialInstruction  Special handling instruction from the customer.
     *
     * @return  self
     */
    public function setSpecialInstruction(string $SpecialInstruction)
    {
        $this->SpecialInstruction = $SpecialInstruction;

        return $this;
    }

    /**
     * Set information entered by a customer for Privileged reference.
     *
     * @param  string  $ReferenceNumber  Information entered by a customer for Privileged reference.
     *
     * @return  self
     */
    public function setReferenceNumber(string $ReferenceNumber)
    {
        $this->ReferenceNumber = $ReferenceNumber;

        return $this;
    }

    /**
     * Set container will be used to indicate Service options, add optional Original service center, destination address and shipment details related to the UPS Worldwide Express Freight and UPS Worldwide Express Freight Midday.
     *
     * @param  FreightOptions  $FreightOptions  Container will be used to indicate Service options, add optional Original service center, destination address and shipment details related to the UPS Worldwide Express Freight and UPS Worldwide Express Freight Midday.
     *
     * @return  self
     */
    public function setFreightOptions(FreightOptions $FreightOptions)
    {
        $this->FreightOptions = $FreightOptions;

        return $this;
    }

    /**
     * Set 03 - transborder
     *
     * @param  string  $ServiceCategory  03 - transborder
     *
     * @return  self
     */
    public function setServiceCategory(string $ServiceCategory)
    {
        $this->ServiceCategory = $ServiceCategory;

        return $this;
    }

    /**
     * Set 03 - transborder
     *
     * @param  string  $CashType  03 - transborder
     *
     * @return  self
     */
    public function setCashType(string $CashType)
    {
        $this->CashType = $CashType;

        return $this;
    }

    /**
     * Set this element should be set to “Y” in the request to indicate that user has pre-printed shipping labels for all the packages, otherwise this will be treated as false.
     *
     * @param  string  $ShippingLabelsAvailable  This element should be set to “Y” in the request to indicate that user has pre-printed shipping labels for all the packages, otherwise this will be treated as false.
     *
     * @return  self
     */
    public function setShippingLabelsAvailable(string $ShippingLabelsAvailable)
    {
        $this->ShippingLabelsAvailable = $ShippingLabelsAvailable;

        return $this;
    }
}
