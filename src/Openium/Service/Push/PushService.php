<?php

    namespace Openium\Service\Push;

    use Openium\Entity\Push\PushEntityInterface;
    use Openium\Entity\Push\PushLoc;
    use Openium\Entity\Push\PushResponse;
    use Openium\Entity\Push\PushServerInfo;
    use Openium\Exception\PushException;

    class PushService
    {
        use PushServiceTrait;

        /** @var PushInformationBuilder */
        protected $pushInformationBuilder;

        /** @var PushServerInfo */
        protected $pushServerInfo;

        /** @var PushLoc */
        protected $pushLoc;

        /**
         * PushService constructor.
         */
        public function __construct()
        {
            $this->pushInformationBuilder = new PushInformationBuilder();
            $this->setPushLocation();
        }

        /**
         * @param bool $isProd
         */
        public function setEnv(bool $isProd = false)
        {
            $this->pushInformationBuilder->setEnv($isProd);
        }

        /**
         * @param string $url
         * @param string $server
         * @param string $id
         * @param string $key
         * @param string $tokenDev
         * @param string $tokenProd
         */
        public function setServerInfo(string $url, string $server, string $id, string $key, string $tokenDev, string $tokenProd)
        {
            $this->pushServerInfo = $this->pushInformationBuilder->create_PushServerInfo($url, $server, $id, $key, $tokenDev, $tokenProd);
        }

        /**
         * @param bool $wantPushLoc
         * @param float|NULL $latitude
         * @param float|NULL $longitude
         * @param int|NULL $radius
         * @param int|NULL $tolerance
         */
        public function setPushLocation(bool $wantPushLoc = false, float $latitude = NULL, float $longitude = NULL, int $radius = NULL, int $tolerance = NULL)
        {
            $this->pushLoc = $this->pushInformationBuilder->create_PushLoc($wantPushLoc, $latitude, $longitude, $radius, $tolerance);
        }

        /**
         * @param PushEntityInterface $object
         * @param array $pushGroup
         * @param array $langs
         *
         * @return PushResponse
         * @throws PushException
         */
        public function push(PushEntityInterface $object, array $pushGroup = [], array $langs = []): PushResponse
        {
            if (!empty($pushGroup)) {
                if (is_null($this->pushServerInfo) || is_null($this->pushLoc)) {
                    $message = "Push Loc or Push Server Info haven't been set";
                    error_log($message);
                    throw new PushException($message);
                }

                $pushNotifier = $this->pushInformationBuilder->create_PushNotifier($this->pushServerInfo, $this->pushLoc, $pushGroup, $langs);
                $pushNotification = $this->pushInformationBuilder->create_PushNotification($object);
                $paramsBag = $this->pushInformationBuilder->create_PushParam($pushNotifier, $pushNotification);

                $pushResponse = $this->makePOSTOn($pushNotifier, $paramsBag);

                if ($pushResponse->getStatus() === -1) {
                    $message = __METHOD__ . ' : Push Send Failed. Result : ' . $pushResponse->getResult();
                    error_log($message);
                    throw new PushException($message);
                }

                $response = json_decode($pushResponse->getResult());

                if (is_null($response)) {
                    $message = __METHOD__ . ' : Push Send Failed. JSON Parse Failed. Result : ' . $pushResponse->getResult();
                    error_log($message);
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
                    error_log($message);
                    throw new PushException($message);
                }

                return $pushResponse;
            } else {
                $message = __METHOD__ . ' : Push Send Failed. Push Group is empty';
                error_log($message);
                throw new PushException($message);
            }
        }
    }
?>