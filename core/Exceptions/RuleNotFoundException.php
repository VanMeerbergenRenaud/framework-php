<?php

namespace Core\Exceptions;

use Exception;

class RuleNotFoundException extends Exception
{
    /**
     * @param string $message
     */
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }
}