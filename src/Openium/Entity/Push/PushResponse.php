<?php

    namespace Openium\Entity\Push;

    class PushResponse
    {
        const STATUS_SUCCESS = 0;

        /** @var int */
        private $status;

        /** @var string */
        private $result;

        /**
         * PushResponse constructor.
         * @param int $status
         * @param string $result
         */
        public function __construct($status, $result)
        {
            $this->status = $status;
            $this->result = $result;
        }

        /**
         * @return int
         */
        public function getStatus(): int
        {
            return $this->status;
        }

        /**
         * @param int $status
         */
        public function setStatus(int $status)
        {
            $this->status = $status;
        }

        /**
         * @return string
         */
        public function getResult(): string
        {
            return $this->result;
        }

        /**
         * @param string $result
         */
        public function setResult(string $result)
        {
            $this->result = $result;
        }
    }
?>