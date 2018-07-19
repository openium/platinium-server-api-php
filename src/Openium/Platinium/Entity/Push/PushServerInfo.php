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
 * Class PushServerInfo
 *
 * @package Openium\Platinium\Entity\Push
 */
class PushServerInfo
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $server;

    /**
     * @var string
     */
    protected $serverId;

    /**
     * @var string
     */
    protected $serverKey;

    /**
     * @var string
     */
    protected $serverTokenDev;

    /**
     * @var string
     */
    protected $serverTokenProd;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getServer(): string
    {
        return $this->server;
    }

    /**
     * @param string $server
     *
     * @return self
     */
    public function setServer(string $server): self
    {
        $this->server = $server;
        return $this;
    }

    /**
     * @return string
     */
    public function getServerId(): string
    {
        return $this->serverId;
    }

    /**
     * @param string $serverId
     *
     * @return self
     */
    public function setServerId(string $serverId): self
    {
        $this->serverId = $serverId;
        return $this;
    }

    /**
     * @return string
     */
    public function getServerKey(): string
    {
        return $this->serverKey;
    }

    /**
     * @param string $serverKey
     *
     * @return self
     */
    public function setServerKey(string $serverKey): self
    {
        $this->serverKey = $serverKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getServerTokenDev(): string
    {
        return $this->serverTokenDev;
    }

    /**
     * @param string $serverTokenDev
     *
     * @return self
     */
    public function setServerTokenDev(string $serverTokenDev): self
    {
        $this->serverTokenDev = $serverTokenDev;
        return $this;
    }

    /**
     * @return string
     */
    public function getServerTokenProd(): string
    {
        return $this->serverTokenProd;
    }

    /**
     * @param string $serverTokenProd
     *
     * @return self
     */
    public function setServerTokenProd(string $serverTokenProd): self
    {
        $this->serverTokenProd = $serverTokenProd;
        return $this;
    }
}
