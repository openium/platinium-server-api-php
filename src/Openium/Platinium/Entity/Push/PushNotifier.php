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
 * Class PushNotifier
 *
 * @package Openium\Platinium\Entity\Push
 */
class PushNotifier
{
    /**
     * @var PushServerInfo
     */
    protected $serverInfo;

    /**
     * @var PushLoc
     */
    protected $pushLoc;

    /**
     * @var array
     */
    protected $groups;

    /**
     * @var array
     */
    protected $langs;

    /**
     * @return PushServerInfo
     */
    public function getServerInfo(): PushServerInfo
    {
        return $this->serverInfo;
    }

    /**
     * @param PushServerInfo $pushServerInfo
     *
     * @return self
     */
    public function setServerInfo(PushServerInfo $pushServerInfo): self
    {
        $this->serverInfo = $pushServerInfo;
        return $this;
    }

    /**
     * @return PushLoc
     */
    public function getPushLoc(): PushLoc
    {
        return $this->pushLoc;
    }

    /**
     * @param PushLoc $pushLoc
     *
     * @return self
     */
    public function setPushLoc(PushLoc $pushLoc): self
    {
        $this->pushLoc = $pushLoc;
        return $this;
    }

    /**
     * @return array
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    /**
     * @param array $groups
     *
     * @return self
     */
    public function setGroups(array $groups): self
    {
        $this->groups = $groups;
        return $this;
    }

    /**
     * @return array
     */
    public function getLangs(): array
    {
        return $this->langs;
    }

    /**
     * @param array $langs
     * @return self
     */
    public function setLangs(array $langs): self
    {
        $this->langs = $langs;
        return $this;
    }
}
