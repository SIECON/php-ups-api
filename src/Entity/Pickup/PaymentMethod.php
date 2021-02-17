<?php

namespace Ups\Entity\Pickup;

abstract class PaymentMethod { 
    const NONE_REQUIRED = '00';
    const SHIPPER_ACCOUNT = '01';
    const CHARGE_CARD = '03';
    const TRACKING_NUMBER_1Z = '04';
    const CHECK_OR_MONEY_ORDER = '05';
    // applicable only for these countries or territories - BE,FR,DE,IT,MX,NL,PL,ES,GB,CZ,HU,FI,NO
    const CASH = '06';
    const PAYPAL = '07';
}