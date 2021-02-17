<?php

namespace Ups;

class JsonResponse implements JsonResponseInterface
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var array
     */
    protected $response;

    /**
     * @return stdClass
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param stdClass $response
     *
     * @return $this
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}
