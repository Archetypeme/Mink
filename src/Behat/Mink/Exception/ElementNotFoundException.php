<?php

namespace Behat\Mink\Exception;

use Behat\Mink\Session;

/*
 * This file is part of the Behat\Mink.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Mink "element not found" exception.
 *
 * @author      Konstantin Kudryashov <ever.zet@gmail.com>
 */
class ElementNotFoundException extends Exception
{
    /**
     * Initializes exception.
     *
     * @param   Behat\Mink\Session  $session    session instance
     * @param   string              $type       element type
     * @param   string              $locator    element locator
     * @param   Exception           $previous   previous exception
     */
    public function __construct(Session $session, $type = null, $locator = null, $previous = null)
    {
        $message = '';

        if (null !== $type) {
            $message .= ucfirst($type);
        } else {
            $message .= 'Tag';
        }

        if (null !== $locator) {
            $message .= ' with locator "' . $locator . '" ';
        }

        $message .= 'not found';

        parent::__construct($message, $session, 0, $previous);
    }

    /**
     * Returns exception message with additional context info.
     *
     * @return  string
     */
    public function __toString()
    {
        return $this->getMessage()." on page:\n\n"
             . $this->getResponseInfo()
             . $this->pipeString($this->trimBody($this->getSession()->getPage()->getContent()) . "\n");
    }
}
