<?php

    namespace Openium\Entity\Push;

    class PushNotification
    {
        /** @var string */
        private $message;

        /** @var int */
        private $badgeValue;

        /**
         * @var string
         *
         * sound name fof notification
         * set by super admin in conf
         */
        private $sound;

        /**
         * @var bool
         *
         * other name : newsstand
         */
        private $isSilentPush = false;

        /** @var array */
        private $paramsBag;

        /**
         * PushNotification constructor.
         * @param string $message
         * @param int $badgeValue
         */
        public function __construct(string $message, int $badgeValue = 0)
        {
            $this->message = $message;
            $this->badgeValue = $badgeValue;
            $this->paramsBag = [];
        }




        # -------------------------------------------------------------
        #   Message
        # -------------------------------------------------------------

        /**
         * @return string
         */
        public function getMessage(): string
        {
            return $this->message;
        }

        /**
         * @param string $message
         *
         * @return self
         */
        public function setMessage(string $message): self
        {
            $this->message = $message;

            return $this;
        }




        # -------------------------------------------------------------
        #   Badge Value
        # -------------------------------------------------------------

        /**
         * @return int
         */
        public function getBadgeValue(): int
        {
            return $this->badgeValue;
        }

        /**
         * @param int $badgeValue
         *
         * @return self
         */
        public function setBadgeValue(int $badgeValue): self
        {
            $this->badgeValue = $badgeValue;

            return $this;
        }




        # -------------------------------------------------------------
        #   Sound
        # -------------------------------------------------------------

        /**
         * @return string
         */
        public function getSound(): ?string
        {
            return $this->sound;
        }

        /**
         * @param string $sound
         *
         * @return self
         */
        public function setSound(string $sound): self
        {
            $this->sound = $sound;

            return $this;
        }




        # -------------------------------------------------------------
        #   Silent Push
        # -------------------------------------------------------------

        /**
         * @return bool
         */
        public function isSilentPush(): bool
        {
            return $this->isSilentPush;
        }

        /**
         * @param bool $isSilentPush
         *
         * @return self
         */
        public function setIsSilentPush(bool $isSilentPush): self
        {
            $this->isSilentPush = $isSilentPush;

            return $this;
        }




        # -------------------------------------------------------------
        #   Params Bag
        # -------------------------------------------------------------

        /**
         * @return array
         */
        public function getParamsBag(): array
        {
            return $this->paramsBag;
        }

        /**
         * @param array $paramsBag
         *
         * @return self
         */
        public function setParamsBag(array $paramsBag): self
        {
            $this->paramsBag = $paramsBag;

            return $this;
        }

        /**
         * @param $key
         * @param $value
         *
         * @return self
         */
        public function addParameter(string $key, string $value): self
        {
            $this->paramsBag[$key] = $value;

            return $this;
        }




        # -------------------------------------------------------------
        #   Parse
        # -------------------------------------------------------------

        /**
         * @return array
         */
        public function toArray(): array
        {
            $jsonArray = array();
            if ($this->isSilentPush()) {
                $jsonArray['newsstand'] = $this->isSilentPush();
            }
            if ($this->getMessage()) {
                $jsonArray['message'] = $this->getMessage();
            }
            if ($this->getSound()) {
                $jsonArray['sound'] = $this->getSound();
            }
            if ($this->getBadgeValue()) {
                $jsonArray['badge'] = $this->getBadgeValue();
            }
            if ($this->getParamsBag()) {
                $jsonArray['paramsbag'] = $this->getParamsBag();
            }
            return $jsonArray;
        }
    }
?>