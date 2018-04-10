<?php

    namespace Openium\Entity\Push;

    class PushServerInfo
    {
        /** @var string */
        var $url;

        /** @var string */
        var $server;

        /** @var string */
        var $serverId;

        /** @var string */
        var $serverKey;

        /** @var string */
        var $serverTokenDev;

        /** @var string */
        var $serverTokenProd;






        # -------------------------------------------------------------
        #   Url
        # -------------------------------------------------------------

        /**
         * @return string
         */
        public function getUrl(): string
        {
            return $this->url;
        }

        /**
         * @param string $url
         * @return self
         */
        public function setUrl(string $url): self
        {
            $this->url = $url;

            return $this;
        }






        # -------------------------------------------------------------
        #   Server
        # -------------------------------------------------------------

        /**
         * @return string
         */
        public function getServer(): string
        {
            return $this->server;
        }

        /**
         * @param string $server
         * @return self
         */
        public function setServer(string $server): self
        {
            $this->server = $server;

            return $this;
        }






        # -------------------------------------------------------------
        #   Server Id
        # -------------------------------------------------------------

        /**
         * @return string
         */
        public function getServerId(): string
        {
            return $this->serverId;
        }

        /**
         * @param string $serverId
         * @return self
         */
        public function setServerId(string $serverId): self
        {
            $this->serverId = $serverId;

            return $this;
        }






        # -------------------------------------------------------------
        #   Server Key
        # -------------------------------------------------------------

        /**
         * @return string
         */
        public function getServerKey(): string
        {
            return $this->serverKey;
        }

        /**
         * @param string $serverKey
         * @return self
         */
        public function setServerKey(string $serverKey): self
        {
            $this->serverKey = $serverKey;

            return $this;
        }






        # -------------------------------------------------------------
        #   Server Token (DEV)
        # -------------------------------------------------------------

        /**
         * @return string
         */
        public function getServerTokenDev(): string
        {
            return $this->serverTokenDev;
        }

        /**
         * @param string $serverTokenDev
         * @return self
         */
        public function setServerTokenDev(string $serverTokenDev): self
        {
            $this->serverTokenDev = $serverTokenDev;

            return $this;
        }






        # -------------------------------------------------------------
        #   Server Token (PROD)
        # -------------------------------------------------------------

        /**
         * @return string
         */
        public function getServerTokenProd(): string
        {
            return $this->serverTokenProd;
        }

        /**
         * @param string $serverTokenProd
         * @return self
         */
        public function setServerTokenProd(string $serverTokenProd): self
        {
            $this->serverTokenProd = $serverTokenProd;

            return $this;
        }
    }
?>