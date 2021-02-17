<?php

namespace Ups;

use Psr\Log\LoggerInterface;

interface RequestInterface
{
    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger = null);

    /**
     * @param string|array|null $access The access request 
     * @param string $request The request body
     * @param string $endpointurl The UPS API Endpoint URL
     * @param string $method HTTP method
     * @param array $headers Extra headers
     *
     * @return ResponseInterface|JsonResponseInterface
     */
    public function request($accesses, $request, $endpointurl, $method, $headers);

    /**
     * @param $access
     */
    public function setAccess($access);

    /**
     * @return string
     */
    public function getAccess();

    /**
     * @param $request
     */
    public function setRequest($request);

    /**
     * @return string
     */
    public function getRequest();

    /**
     * @param $endpointUrl
     */
    public function setEndpointUrl($endpointUrl);

    /**
     * @return string
     */
    public function getEndpointUrl();

    /**
     * @param $method
     */
    public function setMethod(string $method);

    /**
     * @return string
     */
    public function getMethod();

    /**
     * @param $headers
     */
    public function setHeaders(array $headers);

    /**
     * @return array
     */
    public function getHeaders();
}
