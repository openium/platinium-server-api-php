<?php

    namespace Openium\Entity\Push;

    class PushNotifier
    {
        /** @var PushServerInfo */
        var $serverInfo;

        /** @var PushLoc */
        var $pushLoc;

        /** @var array */
        var $groups;

        /** @var array */
        var $langs;






        # -------------------------------------------------------------
        #   Server Info
        # -------------------------------------------------------------

        /**
         * @return PushServerInfo
         */
        public function getServerInfo(): PushServerInfo
        {
            return $this->serverInfo;
        }

        /**
         * @param PushServerInfo $pushServerInfo
         * @return self
         */
        public function setServerInfo(PushServerInfo $pushServerInfo): self
        {
            $this->serverInfo = $pushServerInfo;

            return $this;
        }




        # -------------------------------------------------------------
        #   Push Loc
        # -------------------------------------------------------------

        /**
         * @return PushLoc
         */
        public function getPushLoc(): PushLoc
        {
            return $this->pushLoc;
        }

        /**
         * @param PushLoc $pushLoc
         * @return self
         */
        public function setPushLoc(PushLoc $pushLoc): self
        {
            $this->pushLoc = $pushLoc;

            return $this;
        }




        # -------------------------------------------------------------
        #   Groups
        # -------------------------------------------------------------

        /**
         * @return array
         */
        public function getGroups(): array
        {
            return $this->groups;
        }

        /**
         * @param array $groups
         * @return self
         */
        public function setGroups(array $groups): self
        {
            $this->groups = $groups;

            return $this;
        }




        # -------------------------------------------------------------
        #   Langs
        # -------------------------------------------------------------

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
?>