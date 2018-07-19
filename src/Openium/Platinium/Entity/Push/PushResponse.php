<?php

/**
 * PHP Version 7.1
 *
 * @package  Openium\Platinium\Entity\Push
 * @author   Thomas LEDUC <thomaslmoi15@hotmail.fr>, Alexandre Caillot <a.caillot@openium.fr>
 * @link     https://openium.fr/
 */

namespace Openium\Platinium\Entity\Push;

/**
 * Class PushResponse
 *
 * @package Openium\Platinium\Entity\Push
 */
class PushResponse
{
    /**
     * @var int
     */
    const STATUS_SUCCESS = 0;

    /**
     * @var int
     */
    private $status;

    /**
     * @var string
     */
    private $result;

    /**
     * PushResponse constructor.
     *
     * @param $status
     * @param $result
     */
    public function __construct($status, $result)
    {
        $this->status = $status;
        $this->result = $result;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getResult(): string
    {
        return $this->result;
    }

    /**
     * @param string $result
     */
    public function setResult(string $result)
    {
        $this->result = $result;
    }
}
