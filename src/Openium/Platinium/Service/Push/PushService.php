<?php

/**
 * PHP Version 7.1
 *
 * @package  Openium\Platinium\Entity\Push
 * @author   Thomas LEDUC <thomaslmoi15@hotmail.fr>, Alexandre Caillot <a.caillot@openium.fr>
 * @link     https://openium.fr/
 */

namespace Openium\Platinium\Service\Push;

use Openium\Platinium\Entity\Push\PushEntityInterface;
use Openium\Platinium\Entity\Push\PushLoc;
use Openium\Platinium\Entity\Push\PushResponse;
use Openium\Platinium\Entity\Push\PushServerInfo;
use Openium\Platinium\Exception\PushException;

/**
 * Class PushService
 *
 * @package Openium\Platinium\Service\Push
 */
class PushService
{
    use PushServiceTrait;

    /**
     * @var PushInformationBuilder
     */
    protected $pushInformationBuilder;

    /**
     * @var PushServerInfo
     */
    protected $pushServerInfo;

    /**
     * @var PushLoc
     */
    protected $pushLoc;

    /**
     * PushService constructor.
     *
     * @param bool $isProd
     */
    public function __construct(bool $isProd = false)
    {
        $this->pushInformationBuilder = new PushInformationBuilder($isProd);
        $this->setPushLocation();
    }

    /**
     * @param string $url
     * @param string $server
     * @param string $id
     * @param string $key
     * @param string $tokenDev
     * @param string $tokenProd
     */
    public function setServerInfo(
        string $url,
        string $server,
        string $id,
        string $key,
        string $tokenDev,
        string $tokenProd
    ) {
        $this->pushServerInfo = $this->pushInformationBuilder->createPushServerInfo(
            $url,
            $server,
            $id,
            $key,
            $tokenDev,
            $tokenProd
        );
    }

    /**
     * @param bool $wantPushLoc
     * @param float|NULL $latitude
     * @param float|NULL $longitude
     * @param int|NULL $radius
     * @param int|NULL $tolerance
     */
    public function setPushLocation(
        bool $wantPushLoc = false,
        float $latitude = null,
        float $longitude = null,
        int $radius = null,
        int $tolerance = null
    ) {
        $this->pushLoc = $this->pushInformationBuilder->createPushLoc(
            $wantPushLoc,
            $latitude,
            $longitude,
            $radius,
            $tolerance
        );
    }

    /**
     * @param PushEntityInterface $object
     * @param array $pushGroup
     * @param array $langs
     *
     * @throws PushException
     *
     * @return PushResponse
     */
    public function push(PushEntityInterface $object, array $pushGroup = [], array $langs = []): PushResponse
    {
        if (!empty($pushGroup)) {
            if (is_null($this->pushServerInfo) || is_null($this->pushLoc)) {
                $message = "Push Loc or Push Server Info haven't been set";
                throw new PushException($message);
            }
            $pushNotifier = $this->pushInformationBuilder->createPushNotifier(
                $this->pushServerInfo,
                $this->pushLoc,
                $pushGroup,
                $langs
            );
            $pushNotification = $this->pushInformationBuilder->createPushNotification($object);
            $paramsBag = $this->pushInformationBuilder->createPushParam($pushNotifier, $pushNotification);
            $pushResponse = $this->makePOSTOn($pushNotifier, $paramsBag);
            if ($pushResponse->getStatus() === -1) {
                $message = __METHOD__ . ' : Push Send Failed. Result : ' . $pushResponse->getResult();
                throw new PushException($message);
            }
            $response = json_decode($pushResponse->getResult());
            if (is_null($response)) {
                $message = sprintf(
                    '%s : Push Send Failed. JSON Parse Failed. Result : %s',
                    __METHOD__,
                    $pushResponse->getResult()
                );
                throw new PushException($message);
            }
            if (!property_exists($response, 'id')
                && !property_exists($response, 'is_dev')
                && !property_exists($response, 'ids_groups')
                && !property_exists($response, 'langs')
                && !property_exists($response, 'notification_per_minute')
                && !property_exists($response, 'creation_date')
                && !property_exists($response, 'params')
                && !property_exists($response, 'tolerance')
                && !property_exists($response, 'state')
                && !property_exists($response, 'origin')
                && !property_exists($response, 'token_notifications')
            ) {
                $message = __METHOD__ . ' : Push Send Failed. Result : ' . $pushResponse->getResult();
                throw new PushException($message);
            }
            return $pushResponse;
        } else {
            $message = __METHOD__ . ' : Push Send Failed. Push Group is empty';
            throw new PushException($message);
        }
    }
}
