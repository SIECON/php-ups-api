<?php

namespace Ups\Entity;


class Phone extends SerializableEntity
{
    /**
     * Phone number
     * @var string
     */
    private $Number;

    /**
     * Phone extension
     * @var string
     */
    private $Extension;

    /**
     * Set phone number
     *
     * @param  string  $Number  Phone number
     *
     * @return  self
     */
    public function setNumber(string $Number)
    {
        if (
            $Number !== null &&
            (strlen($Number) > 25)
        ) {
            throw new \Exception("Number must have maximum length 25");
        }
        $this->Number = $Number;

        return $this;
    }

    /**
     * Set phone extension
     *
     * @param  string  $Extension  Phone extension
     *
     * @return  self
     */
    public function setExtension(string $Extension)
    {
        if (
            $Extension !== null &&
            (strlen($Extension) > 10)
        ) {
            throw new \Exception("Extension must have maximum length 10");
        }
        $this->Extension = $Extension;

        return $this;
    }
}
