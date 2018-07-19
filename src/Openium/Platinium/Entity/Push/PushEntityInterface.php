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
 * Interface PushEntityInterface
 *
 * @package  Openium\Platinium\Entity\Push
 */
interface PushEntityInterface
{
    /**
     * Get the Object Id
     *
     * @return array
     */
    public function getPushParams(): array;

    /**
     * Get the contents for the push message
     *
     * @return string
     */
    public function getPushMessage(): string;
}
