<?php

/**
 * PHP Version 7.1
 *
 * @package  Openium\Platinium\Entity\Push
 * @author   Thomas LEDUC <thomaslmoi15@hotmail.fr>, Alexandre Caillot <a.caillot@openium.fr>
 * @link     https://openium.fr/
 */

namespace Openium\Platinium\Exception;

use \Exception;
use \Throwable;

/**
 * Class PushException
 *
 * @package Openium\Platinium\Exception
 */
class PushException extends Exception
{
    /**
     * @var string
     */
    protected const DEFAULT_MESSAGE = 'Error Processing Request';

    /**
     * @var int
     */
    public const DEFAULT_CODE = 500;

    /**
     * LunaException constructor.
     *
     * @param string|null $message
     * @param int $code
     * @param Throwable|null $throwable
     */
    public function __construct(string $message = null, int $code = self::DEFAULT_CODE, Throwable $throwable = null)
    {
        if (is_null($message)) {
            $message = self::DEFAULT_MESSAGE;
        }
        parent::__construct($message, $code, $throwable);
    }

    public function __toString()
    {
        return sprintf("%s: [%s]: {%s}\n", __CLASS__, $this->code, $this->message);
    }
}
