<?php

namespace Ups;

interface JsonResponseInterface
{
    /**
     * @return stdClass
     */
    public function getResponse();

    /**
     * @param stdClass $response
     */
    public function setResponse($response);

    /**
     * @return string
     */
    public function getText();

    /**
     * @param string $text
     */
    public function setText($text);
}
