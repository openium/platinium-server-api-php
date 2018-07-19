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
 * Class PushLoc
 *
 * @package Openium\Platinium\Entity\Push
 */
class PushLoc
{
    /**
     * @var bool
     */
    private $pushLoc;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @var int
     */
    private $tolerance;

    /**
     * @var int
     */
    private $radius;
    
    /**
     * @return bool
     */
    public function isPushLoc(): bool
    {
        return $this->pushLoc;
    }

    /**
     * @param bool $pushLoc
     *
     * @return self
     */
    public function setPushLoc(bool $pushLoc): self
    {
        $this->pushLoc = $pushLoc;
        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     *
     * @return self
     */
    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     *
     * @return self
     */
    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return int
     */
    public function getTolerance(): int
    {
        return $this->tolerance;
    }

    /**
     * @param int $tolerance
     *
     * @return self
     */
    public function setTolerance(int $tolerance): self
    {
        $this->tolerance = $tolerance;
        return $this;
    }

    /**
     * @return int
     */
    public function getRadius(): int
    {
        return $this->radius;
    }

    /**
     * @param int $radius
     *
     * @return PushLoc
     */
    public function setRadius(int $radius): self
    {
        $this->radius = $radius;
        return $this;
    }
}
