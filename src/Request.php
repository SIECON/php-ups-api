<?php

namespace Ups;

use DateTime;
use Exception;
use GuzzleHttp\Client as Guzzle;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use SimpleXMLElement;
use Ups\Exception\InvalidResponseException;
use Ups\Exception\RequestException;

class Request implements RequestInterface, LoggerAwareInterface
{
    /**
     * @var bool
     */
    protected $useJson;

    /**
     * @var string
     */
    protected $access;

    /**
     * @var string
     */
    protected $request;

    /**
     * @var string
     */
    protected $endpointUrl;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var Guzzle
     */
    protected $client;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger = null, $useJson = false)
    {
        if ($logger !== null) {
            $this->setLogger($logger);
        } else {
            $this->setLogger(new NullLogger);
        }
        if ($useJson !== null) {
            $this->useJson = $useJson;
        }
        $this->setClient();
    }

    /**
     * Sets a logger instance on the object.
     *
     * @param LoggerInterface $logger
     *
     * @return null
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * Creates a single instance of the Guzzle client
     *
     * @return null
     */
    public function setClient()
    {
        $this->client = new Guzzle();
    }

    /**
     * Send request to UPS.
     *
     * @param string|array|null $access The access request xml
     * @param string|null $request The json/xml request. It can be null for GET or DELETE requests
     * @param string $endpointurl The UPS API Endpoint URL
     * @param string $method HTTP method
     * @param array $headers Optional headers
     *
     * @throws Exception
     *                   todo: make access, request and endpointurl nullable to make the testable
     *
     * @return ResponseInterface|JsonResponseInterface
     */
    public function request($access, $request, $endpointurl, $method = 'POST', $headers = [])
    {
        $this->setAccess($access);
        $this->setRequest($request);
        $this->setEndpointUrl($endpointurl);
        $this->setMethod($method);
        $this->setHeaders($headers);

        if ($this->useJson) {
            return $this->requestJson();
        } else {
            return $this->requestXML();
        }
    }
    private function requestJson()
    {
        // Log request
        $date = new DateTime();
        $id = $date->format('YmdHisu');
        $this->logger->info('Request To UPS API', [
            'id' => $id,
            'endpointurl' => $this->getEndpointUrl(),
        ]);

        $this->logger->debug('Request: ' . $this->getRequest(), [
            'id' => $id,
            'endpointurl' => $this->getEndpointUrl(),
        ]);
        try {
            $options = [
                'headers' => array_merge([
                    'Content-type' => 'application/json',
                    'Content' => 'application/json',
                ], $this->getAccess(), $this->getHeaders()),
                'http_errors' => true,
            ];
            if ($this->getRequest() !== null) {
                $options['json'] = json_decode($this->getRequest(), true);
            }

            $response = $this->client->request(
                $this->getMethod(),
                $this->getEndpointUrl(),
                $options
            );

            $body = (string) $response->getBody();

            $this->logger->info('Response from UPS API', [
                'id' => $id,
                'endpointurl' => $this->getEndpointUrl(),
            ]);

            $this->logger->debug('Response: ' . $body, [
                'id' => $id,
                'endpointurl' => $this->getEndpointUrl(),
            ]);

            if ($response->getStatusCode() === 200) {
                $body = $this->convertEncoding($body);

                $jsonResponse = json_decode($body);
                $responseTypeKey = array_keys(get_object_vars($jsonResponse))[0];
                $responseType = $jsonResponse->{$responseTypeKey};
                if (isset($responseType->Response) && isset($responseType->Response->ResponseStatus->Code)) {
                    if ($responseType->Response->ResponseStatus->Code == 1) {
                        $responseInstance = new JsonResponse();

                        return $responseInstance->setText($body)->setResponse($responseType);
                    } elseif ($responseType->Response->ResponseStatus->Code == 0) {
                        if (is_array($responseType->Response->Alert)) {
                            throw new Exception(
                                "Failure : {$responseType->Response->Alert[0]->Description}",
                                (int)$responseType->Response->Alert[0]->Code
                            );
                        } else {
                            throw new Exception(
                                "Failure : {$responseType->Response->ResponseStatus->Description}",
                                (int)$responseType->Response->ResponseStatus->Code
                            );
                        }
                    }
                } else {
                    throw new InvalidResponseException('Failure: response is in an unexpected format.');
                }
            }
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            // Catch all 4XX and 5XX errors
            if ($e->hasResponse()) {
                $body = $e->getResponse()->getBody();
                $body = $this->convertEncoding($body);
                $jsonResponse = json_decode($body);

                if (isset($jsonResponse->response) && isset($jsonResponse->response->errors)) {
                    throw new Exception(
                        "Failure : {$jsonResponse->response->errors[0]->message}",
                        (int) $jsonResponse->response->errors[0]->code
                    );
                }
            }
            throw $e;
        } catch (\GuzzleHttp\Exception\TransferException $e) { // Guzzle: All of the exceptions extend from GuzzleHttp\Exception\TransferException
            $this->logger->alert($e->getMessage(), [
                'id' => $id,
                'endpointurl' => $this->getEndpointUrl(),
            ]);

            throw new RequestException('Failure: ' . $e->getMessage());
        }
    }
    private function requestXML()
    {
        // Log request
        $date = new DateTime();
        $id = $date->format('YmdHisu');
        $this->logger->info('Request To UPS API', [
            'id' => $id,
            'endpointurl' => $this->getEndpointUrl(),
        ]);

        $this->logger->debug('Request: ' . $this->getRequest(), [
            'id' => $id,
            'endpointurl' => $this->getEndpointUrl(),
        ]);
        try {
            $response = $this->client->post(
                $this->getEndpointUrl(),
                [
                    'body' => $this->getAccess() . $this->getRequest(),
                    'headers' => [
                        'Content-type' => 'application/x-www-form-urlencoded; charset=utf-8',
                        'Accept-Charset' => 'UTF-8',
                    ],
                    'http_errors' => true,
                ]
            );
            $body = (string)$response->getBody();

            $this->logger->info('Response from UPS API', [
                'id' => $id,
                'endpointurl' => $this->getEndpointUrl(),
            ]);

            $this->logger->debug('Response: ' . $body, [
                'id' => $id,
                'endpointurl' => $this->getEndpointUrl(),
            ]);

            if ($response->getStatusCode() === 200) {
                $body = $this->convertEncoding($body);

                $xml = new SimpleXMLElement($body);
                if (isset($xml->Response) && isset($xml->Response->ResponseStatusCode)) {
                    if ($xml->Response->ResponseStatusCode == 1) {
                        $responseInstance = new Response();

                        return $responseInstance->setText($body)->setResponse($xml);
                    } elseif ($xml->Response->ResponseStatusCode == 0) {
                        $code = (int)$xml->Response->Error->ErrorCode;
                        throw new InvalidResponseException('Failure: ' . $xml->Response->Error->ErrorDescription . ' (' . $xml->Response->Error->ErrorCode . ')', $code);
                    }
                } else {
                    throw new InvalidResponseException('Failure: response is in an unexpected format.');
                }
            }
        } catch (\GuzzleHttp\Exception\TransferException $e) { // Guzzle: All of the exceptions extend from GuzzleHttp\Exception\TransferException
            $this->logger->alert($e->getMessage(), [
                'id' => $id,
                'endpointurl' => $this->getEndpointUrl(),
            ]);

            throw new RequestException('Failure: ' . $e->getMessage());
        }
    }

    /**
     * @param $access
     *
     * @return $this
     */
    public function setAccess($access)
    {
        $this->access = $access;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param $request
     *
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param $endpointUrl
     *
     * @return $this
     */
    public function setEndpointUrl($endpointUrl)
    {
        $this->endpointUrl = $endpointUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndpointUrl()
    {
        return $this->endpointUrl;
    }

    /**
     * @param $body
     * @return string
     */
    protected function convertEncoding($body)
    {
        if (!function_exists('mb_convert_encoding')) {
            return $body;
        }

        $encoding = mb_detect_encoding($body);
        if ($encoding) {
            return mb_convert_encoding($body, 'UTF-8', $encoding);
        }

        return utf8_encode($body);
    }

    /**
     * Get the value of headers
     *
     * @return  array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set the value of headers
     *
     * @param  array  $headers
     *
     * @return  self
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Get the value of method
     *
     * @return  string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the value of method
     *
     * @param  string  $method
     *
     * @return  self
     */
    public function setMethod(string $method)
    {
        $this->method = $method;

        return $this;
    }
}
