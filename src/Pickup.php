<?php

namespace Ups;

use Exception;
use Psr\Log\LoggerInterface;
use Ups\Entity\Pickup\PickupCancelRequest;
use Ups\Entity\Pickup\PickupCreationRequest;
use Ups\Entity\Pickup\PickupGetServiceCenterFacilitiesRequest;
use Ups\Entity\Pickup\PickupPendingStatusRequest;
use Ups\Entity\Pickup\PickupRateRequest;

/**
 * Package Pickup API Wrapper
 * Based on UPS Developer Guide, dated: 12 Jul 2020.
 */
class Pickup extends Ups
{
    const MODULE = 'ship';
    const OBJECT_NAME = 'pickups';
    protected $facilitiesEndpoint = '/pickup/servicecenterlocations';
    protected $politicalDivisionsEndpoint = '/pickup/countries';

    protected $useJson = true;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var JsonResponseInterface
     * TODO: make it private
     */
    public $response;

    /**
     * Valid versions: 
     * - v1607
     * - v1707
     * @var string
     */
    protected $createVersion = 'v1607';

    /**
     * Valid versions: 
     * - v1607
     * - v1707
     * @var string
     */
    protected $rateVersion = 'v1607';

    /**
     * @var string
     */
    protected $statusVersion = 'v1';

    /**
     * @var string
     */
    protected $cancelVersion = 'v1';

    /**
     * @var string
     */
    protected $facilitiesVersion = 'v1';

    /**
     * @var string
     */
    protected $politicalDivisionsVersion = 'v1';

    /**
     * @var array
     */
    protected $validPickupTypes = ['oncall', 'smart', 'both'];

    /**
     * @var array
     */
    protected $validCancelBy = ['accountnumber', 'prn'];

    /**
     * @param string|null $accessKey UPS License Access Key
     * @param string|null $userId UPS User ID
     * @param string|null $password UPS User Password
     * @param bool $useIntegration Determine if we should use production or CIE URLs.
     * @param RequestInterface|null $request
     * @param LoggerInterface|null PSR3 compatible logger (optional)
     */
    public function __construct($accessKey = null, $userId = null, $password = null, $useIntegration = false, RequestInterface $request = null, LoggerInterface $logger = null)
    {
        if (null !== $request) {
            $this->setRequest($request);
        }

        parent::__construct($accessKey, $userId, $password, $useIntegration, $logger);
    }

    /**
     * Create a Pickup creation request
     * @param PickupCreationRequest $pickupCreationRequest
     * @throws Exception
     *
     * @return \stdClass
     */
    public function create(PickupCreationRequest $pickupCreationRequest)
    {
        // Create request
        $access = $this->createAccess();
        $request = json_encode([
            'PickupCreationRequest' => $pickupCreationRequest
        ]);
        $endpointUrl = $this->compileEndpointUrl('/' . self::MODULE . '/' . $this->createVersion . '/' . self::OBJECT_NAME);

        $this->response = $this->getRequest()->request($access, $request, $endpointUrl);
        $response = $this->response->getResponse();

        if (null === $response) {
            throw new Exception('Failure (0): Unknown error', 0);
        }

        return $response;
    }

    /**
     * Create a Pickup rate request
     * @param PickupRateRequest $pickupRateRequest
     * @throws Exception
     *
     * @return \stdClass
     */
    public function rate(PickupRateRequest $pickupRateRequest)
    {
        // Create request
        $access = $this->createAccess();
        $request = json_encode([
            'PickupRateRequest' => $pickupRateRequest
        ]);
        $endpointUrl = $this->compileEndpointUrl('/' . self::MODULE . '/' . $this->rateVersion . '/' . self::OBJECT_NAME . '/rating');

        $this->response = $this->getRequest()->request($access, $request, $endpointUrl);
        $response = $this->response->getResponse();

        if (null === $response) {
            throw new Exception('Failure (0): Unknown error', 0);
        }

        return $response;
    }

    /**
     * Create a Pickup Pending Status request
     * @param PickupPendingStatusRequest $pickupPendingStatusRequest
     * @throws Exception
     *
     * @return \stdClass
     */
    public function status(PickupPendingStatusRequest $pickupPendingStatusRequest)
    {
        if (!in_array($pickupPendingStatusRequest->getPickupType(), $this->validPickupTypes)) {
            throw new Exception('Failure: Invalid pickup type. It should be on of: ' . implode(',', $this->validPickupTypes), 0);
        }
        // Create request
        $access = $this->createAccess();
        $headers = [
            'AccountNumber' => $pickupPendingStatusRequest->getAccountNumber()
        ];
        $endpointUrl = $this->compileEndpointUrl('/' . self::MODULE . '/' . $this->statusVersion . '/' . self::OBJECT_NAME . '/' . $pickupPendingStatusRequest->getPickupType());

        $this->response = $this->getRequest()->request($access, null, $endpointUrl, 'GET', $headers);
        $response = $this->response->getResponse();

        if (null === $response) {
            throw new Exception('Failure (0): Unknown error', 0);
        }

        return $response;
    }

    /**
     * Create a Pickup Cancel request
     * @param PickupCancelRequest $pickupCancelRequest
     * @throws Exception
     *
     * @return \stdClass
     */
    public function cancel(PickupCancelRequest $pickupCancelRequest)
    {
        if (!in_array($pickupCancelRequest->getCancelBy(), $this->validCancelBy)) {
            throw new Exception('Failure: Invalid cancel by. It should be on of: ' . implode(',', $this->validCancelBy), 0);
        }
        // Create request
        $access = $this->createAccess();
        $headers = [];
        if ($pickupCancelRequest->getCancelBy() === 'prn') {
            $headers['Prn'] = $pickupCancelRequest->getPRN();
        }
        $endpointUrl = $this->compileEndpointUrl('/' . self::MODULE . '/' . $this->cancelVersion . '/' . self::OBJECT_NAME . '/' . $pickupCancelRequest->getCancelBy());

        $this->response = $this->getRequest()->request($access, null, $endpointUrl, 'DELETE', $headers);
        $response = $this->response->getResponse();

        if (null === $response) {
            throw new Exception('Failure (0): Unknown error', 0);
        }

        return $response;
    }

    /**
     * Get Pickup Service center facilities request
     * @param PickupGetServiceCenterFacilitiesRequest $pickupGetServiceCenterFacilitiesRequest
     * @throws Exception
     *
     * @return \stdClass
     */
    public function facilities(PickupGetServiceCenterFacilitiesRequest $pickupGetServiceCenterFacilitiesRequest)
    {
        // Create request
        $access = $this->createAccess();
        $request = json_encode([
            'PickupGetServiceCenterFacilitiesRequest' => $pickupGetServiceCenterFacilitiesRequest
        ]);
        $endpointUrl = $this->compileEndpointUrl('/' . self::MODULE . '/' . $this->facilitiesVersion . $this->facilitiesEndpoint);

        $this->response = $this->getRequest()->request($access, $request, $endpointUrl);
        $response = $this->response->getResponse();

        if (null === $response) {
            throw new Exception('Failure (0): Unknown error', 0);
        }

        return $response;
    }

    /**
     * Get Pickup Political divisions request
     * @param string $countryCode
     * @throws Exception
     *
     * @return \stdClass
     */
    public function politicalDivisions($countryCode)
    {
        // Create request
        $access = $this->createAccess();

        $endpointUrl = $this->compileEndpointUrl('/' . self::MODULE . '/' . $this->politicalDivisionsVersion . $this->politicalDivisionsEndpoint . '/' . $countryCode);

        $this->response = $this->getRequest()->request($access, null, $endpointUrl, 'GET');
        $response = $this->response->getResponse();

        if (null === $response) {
            throw new Exception('Failure (0): Unknown error', 0);
        }

        return $response;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        if (null === $this->request) {
            $this->request = new Request($this->logger, $this->useJson);
        }

        return $this->request;
    }

    /**
     * @param RequestInterface $request
     *
     * @return $this
     */
    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Set - v1707
     *
     * @param  string  $createVersion  - v1707
     *
     * @return  self
     */
    public function setCreateVersion(string $createVersion)
    {
        $this->createVersion = $createVersion;

        return $this;
    }

    /**
     * Set - v1707
     *
     * @param  string  $rateVersion  - v1707
     *
     * @return  self
     */
    public function setRateVersion(string $rateVersion)
    {
        $this->rateVersion = $rateVersion;

        return $this;
    }

    /**
     * Set the value of statusVersion
     *
     * @param  string  $statusVersion
     *
     * @return  self
     */
    public function setStatusVersion(string $statusVersion)
    {
        $this->statusVersion = $statusVersion;

        return $this;
    }

    /**
     * Set the value of facilitiesVersion
     *
     * @param  string  $facilitiesVersion
     *
     * @return  self
     */
    public function setFacilitiesVersion(string $facilitiesVersion)
    {
        $this->facilitiesVersion = $facilitiesVersion;

        return $this;
    }

    /**
     * Set the value of politicalDivisionsVersion
     *
     * @param  string  $politicalDivisionsVersion
     *
     * @return  self
     */
    public function setPoliticalDivisionsVersion(string $politicalDivisionsVersion)
    {
        $this->politicalDivisionsVersion = $politicalDivisionsVersion;

        return $this;
    }
}
