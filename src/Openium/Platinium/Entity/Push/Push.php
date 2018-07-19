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
 * Class Push
 *
 * @package Openium\Platinium\Entity\Push
 */
class Push implements PushEntityInterface
{
    /**
     * @var string
     */
    protected $message;

    /**
     * @var array
     */
    protected $params;

    /**
     * Push constructor.
     *
     * @param string $message
     * @param array $params
     *
     */
    public function __construct(string $message, array $params = [])
    {
        $this->message = $message;
        $this->params = $params;
    }

    /**
     * Get the Object Id
     *
     * @return array
     */
    public function getPushParams(): array
    {
        return $this->params;
    }

    /**
     * Setter for params
     *
     * @param array $params
     *
     * @return self
     */
    public function setParams(array $params): self
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    public function addParam(string $key, string $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * Get the contents for the push message
     *
     * @return string
     */
    public function getPushMessage(): string
    {
        return $this->message;
    }

    /**
     * Setter for message
     *
     * @param string $message
     *
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }
}
