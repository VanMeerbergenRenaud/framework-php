<?php

namespace Core\Exceptions;

use Exception;

class FileNotFoundException extends Exception
{
    /**
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}