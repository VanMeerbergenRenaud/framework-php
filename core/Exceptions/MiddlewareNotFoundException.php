<?php

namespace Core\Exceptions;

class MiddlewareNotFoundException extends \Exception
{
    /**
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}