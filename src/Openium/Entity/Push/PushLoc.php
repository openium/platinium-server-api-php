<?php

    namespace Openium\Entity\Push;

    class PushLoc
    {
        /** @var bool */
        var $pushLoc;

        /** @var float */
        var $latitude;

        /** @var float */
        var $longitude;

        /** @var int */
        var $tolerance;

        /** @var int */
        var $radius;




        # -------------------------------------------------------------
        #   Want Push Loc
        # -------------------------------------------------------------

        /**
         * @return bool
         */
        public function isPushLoc(): bool
        {
            return $this->pushLoc;
        }

        /**
         * @param bool $pushLoc
         * @return self
         */
        public function setPushLoc(bool $pushLoc): self
        {
            $this->pushLoc = $pushLoc;

            return $this;
        }




        # -------------------------------------------------------------
        #   Latitude (For Push Loc)
        # -------------------------------------------------------------

        /**
         * @return float
         */
        public function getLatitude(): float
        {
            return $this->latitude;
        }

        /**
         * @param float $latitude
         * @return self
         */
        public function setLatitude(float $latitude): self
        {
            $this->latitude = $latitude;

            return $this;
        }




        # -------------------------------------------------------------
        #   Longitude (For Push Loc)
        # -------------------------------------------------------------

        /**
         * @return float
         */
        public function getLongitude(): float
        {
            return $this->longitude;
        }

        /**
         * @param float $longitude
         * @return self
         */
        public function setLongitude(float $longitude): self
        {
            $this->longitude = $longitude;

            return $this;
        }




        # -------------------------------------------------------------
        #   Tolerance (For Push Loc)
        # -------------------------------------------------------------

        /**
         * @return int
         */
        public function getTolerance(): int
        {
            return $this->tolerance;
        }

        /**
         * @param int $tolerance
         * @return self
         */
        public function setTolerance(int $tolerance): self
        {
            $this->tolerance = $tolerance;

            return $this;
        }




        # -------------------------------------------------------------
        #   Radius (For Push Loc)
        # -------------------------------------------------------------

        /**
         * @return int
         */
        public function getRadius(): int
        {
            return $this->radius;
        }

        /**
         * @param int $radius
         * @return self
         */
        public function setRadius(int $radius): self
        {
            $this->radius = $radius;

            return $this;
        }
    }
?>