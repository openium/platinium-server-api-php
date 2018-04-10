<?php

    namespace Openium\Entity\Push;

    interface PushEntityInterface
    {
        /**
         * Get the Object Id
         * @return array
         */
        public function getPushParams(): array;

        /**
         * Get the contents for the push message
         * @return string
         */
        public function getPushMessage(): string;
    }
?>