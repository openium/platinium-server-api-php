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
use Openium\Platinium\Entity\Push\PushNotification;
use Openium\Platinium\Entity\Push\PushNotifier;
use Openium\Platinium\Entity\Push\PushServerInfo;

/**
 * Class PushInformationBuilder
 *
 * @package Openium\Platinium\Service\Push
 */
class PushInformationBuilder
{
    /**
     * @var int
     */
    protected const ENV_DEV = 0;

    /**
     * @var int
     */
    protected const ENV_PROD = 1;

    /**
     * @var int
     */
    protected $env;

    /**
     * PushInformationBuilder constructor.
     *
     * @param bool $isProd
     */
    public function __construct(bool $isProd = false)
    {
        $this->setEnv($isProd);
    }

    /**
     * @param bool $isProd
     */
    public function setEnv(bool $isProd)
    {
        $this->env = $isProd ? self::ENV_PROD : self::ENV_DEV;
    }

    /**
     * @return bool
     */
    public function isDev(): bool
    {
        return $this->env === self::ENV_DEV;
    }

    /**
     * @return bool
     */
    public function isProd(): bool
    {
        return $this->env === self::ENV_PROD;
    }

    /**
     * @param string $url
     * @param string $server
     * @param string $id
     * @param string $key
     * @param string $tokenDev
     * @param string $tokenProd
     *
     * @return PushServerInfo
     */
    public function createPushServerInfo(
        string $url,
        string $server,
        string $id,
        string $key,
        string $tokenDev,
        string $tokenProd
    ): PushServerInfo {
        $pushServerInfo = new PushServerInfo();
        $pushServerInfo->setUrl($url);
        $pushServerInfo->setServer($server);
        $pushServerInfo->setServerId($id);
        $pushServerInfo->setServerKey($key);
        $pushServerInfo->setServerTokenDev($tokenDev);
        $pushServerInfo->setServerTokenProd($tokenProd);
        return $pushServerInfo;
    }


    /**
     * @param bool $wantPushLoc
     * @param float|null $latitude
     * @param float|null $longitude
     * @param int|null $radius
     * @param int|null $tolerance
     *
     * @return PushLoc
     */
    public function createPushLoc(
        bool $wantPushLoc = false,
        float $latitude = null,
        float $longitude = null,
        int $radius = null,
        int $tolerance = null
    ): PushLoc {
        $pushLoc = new PushLoc();
        $pushLoc->setPushLoc($wantPushLoc);
        if ($pushLoc
            && !is_null($latitude)
            && !is_null($longitude)
            && !is_null($radius)
            && !is_null($tolerance)
        ) {
            $pushLoc
                ->setLatitude($latitude)
                ->setLongitude($longitude)
                ->setRadius($radius)
                ->setTolerance($tolerance);
        }
        return $pushLoc;
    }


    /**
     * @param PushServerInfo $pushServerInfo
     * @param PushLoc $pushLoc
     * @param array $groups
     * @param array $langs
     *
     * @return PushNotifier
     */
    public function createPushNotifier(
        PushServerInfo $pushServerInfo,
        PushLoc $pushLoc,
        array $groups = [],
        array $langs = []
    ): PushNotifier {
        $pushNotifier = new PushNotifier();
        $pushNotifier
            ->setServerInfo($pushServerInfo)
            ->setPushLoc($pushLoc)
            ->setGroups($groups)
            ->setLangs($langs);
        return $pushNotifier;
    }

    /**
     * @param PushEntityInterface $object
     *
     * @return PushNotification
     */
    public function createPushNotification(PushEntityInterface $object): PushNotification
    {
        $message = $object->getPushMessage();
        $pushNotification = new PushNotification($message);
        $pushNotification->setParamsBag($object->getPushParams());
        return $pushNotification;
    }

    /**
     * @param PushNotifier $pushNotifier
     * @param PushNotification $pushNotification
     *
     * @return array
     */
    public function createPushParam(PushNotifier $pushNotifier, PushNotification $pushNotification): array
    {
        // Parse object to JSON Format
        $notificationJSON = sprintf('[%s]', json_encode($pushNotification->toArray()));
        // Get the Correct Token (Depend to environment, Dev or Prod)
        if ($this->isDev()) {
            $token = $pushNotifier->getServerInfo()->getServerTokenDev();
        } else {
            $token = $pushNotifier->getServerInfo()->getServerTokenProd();
        }
        // Prepare ParamsBag for Push
        $paramsBag = [
            'api_notify[app]' => $token,
            'api_notify[params]' => $notificationJSON
        ];
        if (count($pushNotifier->getGroups()) > 0) {
            $paramsBag['api_notify[idsGroups]'] = json_encode($pushNotifier->getGroups());
        }
        if (count($pushNotifier->getLangs()) > 0) {
            $paramsBag['api_notify[langs]'] = json_encode($pushNotifier->getLangs());
        }
        // Configuration for Push Loc
        $wantPushLoc = $pushNotifier->getPushLoc()->isPushLoc();
        if ($wantPushLoc
            && !empty($pushNotifier->getPushLoc()->getLatitude())
            && !empty($pushNotifier->getPushLoc()->getLongitude())
            && !empty($pushNotifier->getPushLoc()->getRadius())
            && !empty($pushNotifier->getPushLoc()->getTolerance())
        ) {
            $paramsBag['api_notify[latitude]'] = $pushNotifier->getPushLoc()->getLatitude();
            $paramsBag['api_notify[longitude]'] = $pushNotifier->getPushLoc()->getLongitude();
            $paramsBag['api_notify[radius]'] = $pushNotifier->getPushLoc()->getRadius();
            $paramsBag['api_notify[tolerance]'] = $pushNotifier->getPushLoc()->getTolerance();
        }
        return $paramsBag;
    }

    /**
     * @param string $httpVerb
     * @param PushNotifier $pushNotifier
     * @param array|null $params
     *
     * @return array
     */
    public function createServerSignature(string $httpVerb, PushNotifier $pushNotifier, array $params = null): array
    {
        $timestamp = (string)round(microtime(1) * 1000);
        $url = $pushNotifier->getServerInfo()->getUrl();
        $apiServerId = $pushNotifier->getServerInfo()->getServerId();
        $apiServerKey = $pushNotifier->getServerInfo()->getServerKey();
        $paramString = '';
        if ($params) {
            $paramString = str_replace('+', '%20', http_build_query($params));
        }
        $stringToSign = sprintf(
            "%s\n%s\n%s\n%s\n%s",
            $httpVerb,
            $url,
            $paramString,
            $timestamp,
            $apiServerKey
        );
        $signature = sha1($stringToSign);
        $header = sprintf(
            "x-ws-signature: WS-Signature UUID=\"%s\", Signature=\"%s\", Created=\"%s\"",
            $apiServerId,
            $signature,
            $timestamp
        );
        return [$header];
    }
}
