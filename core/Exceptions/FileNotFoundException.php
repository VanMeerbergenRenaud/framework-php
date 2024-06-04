<?php

namespace Core\Exceptions;

use Exception;

class FileNotFoundException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
